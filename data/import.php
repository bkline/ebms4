<?php

date_default_timezone_set('America/New_York');
$now = date('Y-m-d G:i:s');
$base = 'https://eutils.ncbi.nlm.nih.gov/entrez/eutils/efetch.fcgi';
$parms = 'db=pubmed&rettype=medline&retmode=xml&id=30243530';
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $base);
curl_setopt($ch, CURLOPT_POST, TRUE);
curl_setopt($ch, CURLOPT_POSTFIELDS, $parms);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
$results = curl_exec($ch);
if (!$results) {
  $err = curl_error($ch);
  echo "Unable to retrieve data from NLM: $err\n";
}
else {
  echo "fetched article\n"; // "$results\n";
}
$reader = new XMLReader;
$reader->xml($results);
while ($reader->read()) {
  if ($reader->nodeType === XMLReader::ELEMENT) {
    $tag = $reader->name;
    if ($tag === 'PubmedArticle') {
      $node = new SimpleXMLElement($reader->readOuterXML());
      $citation = $node->MedlineCitation;
      $journal_info = $citation->MedlineJournalInfo;
      $article = $citation->Article;
      $journal = $article->Journal;
      $journal_issue = $journal->JournalIssue;
      $pagination = trim($article->Pagination->MedlinePgn);
      $volume = trim($journal_issue->Volume);
      $issue = trim($journal_issue->Issue);
      $pub_date = $journal_issue->PubDate;
      $pub_year = trim($pub_date->Year);
      $pub_month = trim($pub_date->Month);
      $pub_day = trim($pub_date->Day);
      $season = trim($pub_date->Season);
      $medline_date = trim($pub_date->MedlineDate);
      $date_values = [];
      if (!empty($medline_date)) {
        $date_values['medline_date'] = $medline_date;
        preg_match('/[^\d]*(\d\d\d\d).*/', $medline_date, $matches);
        if (!empty($matches[1])) {
          $year = (int)$matches[1];
        }
      }
      if (!empty($pub_year)) {
        $year = (int)$pub_year;
        $date_values['year'] = $pub_year;
      }
      if (!empty($pub_month)) {
        $date_values['month'] = $pub_month;
      }
      if (!empty($pub_day)) {
        $date_values['day'] = $pub_day;
      }
      if (!empty($pub_season)) {
        $date_values['season'] = $pub_season;
      }

      // Assemble the article property values we know we'll have.
      $values = [
        'title' => trim($article->ArticleTitle),
        'authors' => [],
        'source' => 'Pubmed',
        'source_id' => trim($citation->PMID),
        'source_journal_id' => trim($journal_info->NlmUniqueID),
        'source_status' => trim($citation['Status']),
        'journal_title' => trim($journal->Title),
        'brief_journal_title' => trim($journal_info->MedlineTA),
        'abstract' => [],
        'pub_date' => $date_values,
        'year' => $year,
        'imported_by' => 1,
        'import_date' => $now,
      ];

      // Optionally add some properties which we might not have.
      if (!empty($volume)) {
        $values['volume'] = $volume;
      }
      if (!empty($issue)) {
        $values['issue'] = $issue;
      }
      if (!empty($pagination)) {
        $values['pagination'] = $pagination;
      }

      // Populate the array of authors for the article.
      if (!empty($article->AuthorList->Author)) {
        foreach ($article->AuthorList->Author as $author) {
          $collective_name = trim($author->CollectiveName);
          $last_name = trim($author->LastName);
          $first_name = trim($author->ForeName);
          $initials = trim($author->Initials);
          $author_values = [];
          if (!empty($last_name)) {
            $author_values['last_name'] = $last_name;
          }
          if (!empty($first_name)) {
            $author_values['first_name'] = $first_name;
          }
          if (!empty($initials)) {
            $author_values['initials'] = $initials;
          }
          if (!empty($collective_name)) {
            $author_values['collective_name'] = $collective_name;
          }
          $values['authors'][] = $author_values;
        }
      }

      // Collect the paragraphs for the article's abstract.
      if (!empty($article->Abstract)) {
        foreach ($article->Abstract->AbstractText as $text) {
          $values['abstract'][] = [
            'paragraph_text' => trim($text),
            'paragraph_label' => trim($text['Label']),
          ];
        }
      }
      //echo 'testing ' . $whatever . "\n";
      //echo 'testing ' . $article->Whatever . "\n";
      //var_dump($issue->PubDate);
      //var_dump($values);
      print_r($values);
      $article_node = \Drupal\ebms_article\Entity\Article::create($values);
      $article_node->save();
      echo 'article ' . $article_node->id() . " saved\n";
    }
  }
}
