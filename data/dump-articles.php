<?php

$storage = \Drupal::entityTypeManager()->getStorage('ebms_article');
$articles = $storage->loadMultiple();
foreach ($articles as $article) {
  // print_r($article);
  $id = $article->id();
  $title = $article->title->value;
  $source = $article->source->value;
  $source_id = $article->source_id->value;
  $source_journal_id = $article->source_journal_id->value;
  $source_status = $article->source_status->value;
  $journal_title = $article->journal_title->value;
  $brief_journal_title = $article->brief_journal_title->value;
  $volume = $article->volume->value;
  $issue = $article->issue->value;
  $pagination = $article->pagination->value;
  $pub_date = $article->pub_date[0]->toString();
  $year = $article->year->value;
  $imported_by = $article->imported_by->entity->getDisplayName();
  $import_date = $article->import_date->value;
  $update_date = $article->update_date->value;
  $data_mod = $article->data_mod->value;
  $data_checked = $article->data_checked->value;
  $authors = [];
  foreach ($article->authors as $author)
    $authors[] = $author->name;
  $authors = implode(', ', $authors);
  echo "           ID = $id\n";
  echo "        Title = $title\n";
  echo "      Authors = $authors\n";
  echo "       Status = $source_status\n";
  echo "   Journal ID = $source_journal_id\n";
  echo "Journal Title = $journal_title\n";
  echo " Journal Abbr = $brief_journal_title\n";
  echo "       Volume = $volume\n";
  echo "        Issue = $issue\n";
  echo "   Pagination = $pagination\n";
  echo "     Pub Date = $pub_date\n";
  echo "         Year = $year\n";
  echo "  Imported By = $imported_by\n";
  echo "  Import Date = $import_date\n";
  echo "Data Modified = $data_mod\n";
  echo " Data Checked = $data_checked\n";
  echo "     Abstract =\n";
  foreach ($article->abstract as $abstract) {
    echo $abstract->paragraph_label . ': ' . $abstract->paragraph_text . "\n";
  }
}
