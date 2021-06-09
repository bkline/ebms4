<?php

namespace Drupal\ebms_article\Entity;

use Drupal\Core\Entity\ContentEntityBase;
use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\EntityTypeInterface;
use Drupal\Core\Field\BaseFieldDefinition;
use Drupal\Component\Utility\Html;
use Drupal\Core\Field\FieldStorageDefinitionInterface;
use Drupal\ebms_article\ArticlePublication;

/**
 * Article to be reviewed by PDQ boards.
 *
 * @ingroup ebms
 *
 * @ContentEntityType(
 *   id = "ebms_article",
 *   label = @Translation("Article"),
 *   handlers = {
 *     "view_builder" = "Drupal\Core\Entity\EntityViewBuilder",
 *     "list_builder" = "Drupal\ebms\ArticleListBuilder",
 *     "form" = {
 *       "default" = "Drupal\ebms\Form\ArticleForm",
 *       "edit" = "Drupal\ebms\Form\ArticleForm",
 *     },
 *     "route_provider" = {
 *       "html" = "Drupal\Core\Entity\Routing\AdminHtmlRouteProvider",
 *     },
 *   },
 *   base_table = "ebms_article",
 *   admin_permission = "access ebms article overview",
 *   translatable = FALSE,
 *   entity_keys = {
 *     "id" = "id",
 *     "label" = "source_id",
 *     "published" = "active",
 *   },
 *   links = {
 *     "canonical" = "/ebms_article/{ebms_article}",
 *     "edit-form" = "/ebms_article/{ebms_article}/edit",
 *     "collection" = "/admin/content/ebms_article",
 *   }
 * )
 */
class Article extends ContentEntityBase implements ContentEntityInterface {

  /**
   * {@inheritdoc}
   */
  public static function baseFieldDefinitions(EntityTypeInterface $entity_type) {
    $fields = parent::baseFieldDefinitions($entity_type);
    $fields['title'] = BaseFieldDefinition::create('string')
      ->setLabel('Title')
      ->setRequired(TRUE)
      ->setDescription('Official title of the article.')
      ->setDisplayOptions('view', ['label' => 'hidden'])
      ->setSettings(['max_length' => 5000]);
    $fields['authors'] = BaseFieldDefinition::create('ebms_author')
      ->setLabel('Authors')
      ->setDescription('Individuals and/or corporate entities who wrote the article.')
      ->setDisplayOptions('view', ['label' => 'above', 'type' => 'string'])
      ->setCardinality(FieldStorageDefinitionInterface::CARDINALITY_UNLIMITED);
    $fields['source'] = BaseFieldDefinition::create('string')
      ->setLabel('Source')
      ->setRequired(TRUE)
      ->setSettings(['max_length' => 32])
      ->setDisplayOptions('view', ['label' => 'inline'])
      ->setDescription('Source of information about the article.');
    $fields['source_id'] = BaseFieldDefinition::create('string')
      ->setLabel('Source ID')
      ->setRequired(TRUE)
      ->setSettings(['max_length' => 32])
      ->setDisplayOptions('view', ['label' => 'inline'])
      ->setDescription('Identifier for the article, unique for the source.');
    $fields['source_journal_id'] = BaseFieldDefinition::create('string')
      ->setLabel('Journal ID')
      ->setRequired(TRUE)
      ->setSettings(['max_length' => 32])
      ->setDisplayOptions('view', ['label' => 'inline'])
      ->setDescription("Source ID for the article's journal.");

    // Add the calculated publication field.
    $fields['publication'] = BaseFieldDefinition::create('string')
      ->setComputed(TRUE)
      ->setName('publication')
      ->setClass(ArticlePublication::class)
      ->setDescription("Information about the article's publication")
      ->setDisplayOptions('view', ['label' => 'inline'])
      ->setLabel('Publication');

    $fields['source_status'] = BaseFieldDefinition::create('string')
      ->setLabel('Status')
      ->setSettings(['max_length' => 32])
      //->setDisplayOptions('view', ['label' => 'above'])
      ->setDisplayOptions('view', ['label' => 'inline'])
      ->setDescription('Status of the article in the source system.');
    $fields['journal_title'] = BaseFieldDefinition::create('string')
      ->setLabel('Journal Title')
      //->setDisplayOptions('view', ['label' => 'above'])
      ->setRequired(TRUE)
      ->setSettings(['max_length' => 512])
      ->setDescription('Full title of the journal as given in this article.');
    $fields['brief_journal_title'] = BaseFieldDefinition::create('string')
      ->setLabel('Journal Abbreviation')
      ->setSettings(['max_length' => 127])
      //->setDisplayOptions('view', ['label' => 'above'])
      ->setDescription('Shortened version of the journal title as given in this article.');
    $fields['volume'] = BaseFieldDefinition::create('string')
      ->setLabel('Journal Volume')
      ->setSettings(['max_length' => 127])
      //->setDisplayOptions('view', ['label' => 'above'])
      ->setDescription('Volume of the journal in which this article appears.');
    $fields['issue'] = BaseFieldDefinition::create('string')
      ->setLabel('Journal Issue')
      ->setSettings(['max_length' => 127])
      //->setDisplayOptions('view', ['label' => 'above'])
      ->setDescription('Issue of the journal in which this article appears.');
    $fields['pagination'] = BaseFieldDefinition::create('string')
      ->setLabel('Pagination')
      ->setSettings(['max_length' => 127])
      //->setDisplayOptions('view', ['label' => 'above'])
      ->setDescription('Pages on which this article appears.');

    // This approach is an enhancement to the original EBMS, which stored the
    // abstract as a single string, failing to preserve paragraph divisions.
    $fields['abstract'] = BaseFieldDefinition::create('ebms_abstract_paragraph')
      ->setLabel('Abstract')
      ->setDescription("Paragraphs for the article's summary.")
      ->setDisplayOptions('view', ['label' => 'above'])
      ->setCardinality(FieldStorageDefinitionInterface::CARDINALITY_UNLIMITED);

    // @todo Consider replacing this with a plain string.
    // @todo Point out to Robin that searching on months is partly broken.
    $fields['pub_date'] = BaseFieldDefinition::create('ebms_pub_date')
      ->setLabel('Publication Date')
      ->setRequired(TRUE)
      //->setDisplayOptions('view', ['label' => 'above', 'type' => 'ebms_pub_date_formatter'])
      ->setDescription("Date of the article's publication.");
    $fields['year'] = BaseFieldDefinition::create('integer')
      ->setLabel('Publication Year')
      ->setDisplayOptions('view', ['label' => 'inline'])
      ->setDescription('Year in which the article was published.');
    $fields['imported_by'] = BaseFieldDefinition::create('entity_reference')
      ->setLabel(t('Imported By'))
      ->setDisplayOptions('view', ['label' => 'inline'])
      ->setRequired(TRUE)
      ->setDescription(t('User who first imported this article.'))
      ->setSetting('target_type', 'user');
    $fields['import_date'] = BaseFieldDefinition::create('datetime')
      ->setLabel('Import Date')
      ->setRequired(TRUE)
      // XXX broken
      ->setDisplayOptions('view', [
        'label' => 'inline',
        'type' => 'datetime',
        //'settings' => ['date_format' => 'Y-m-d'],
      ])
      ->setDescription('When the article information was first retrieved from NLM.');
    $fields['update_date'] = BaseFieldDefinition::create('datetime')
      ->setLabel('Update Date')
      ->setDisplayOptions('view', ['label' => 'inline'])
      ->setDescription('When the article information was last refreshed from NLM.');
    $fields['data_mod'] = BaseFieldDefinition::create('datetime')
      ->setLabel('Article Data Modified by NLM')
      ->setSettings(['datetime_type' => 'date'])
      ->setDisplayOptions('view', ['label' => 'inline'])
      ->setDescription(t('When the article information was last modified at NLM.'));
    $fields['data_checked'] = BaseFieldDefinition::create('datetime')
      ->setLabel('When We Last Checked with NLM for Updates')
      ->setSettings(['datetime_type' => 'date'])
      ->setDisplayOptions('view', ['label' => 'inline'])
      ->setDescription(t('When we last checked that we have the most recent XML from NLM.'));

    // @todo Consider using a plain file URL field instead.
    $fields['full_text'] = BaseFieldDefinition::create('file')
      ->setLabel('Full Text File')
      ->setDisplayOptions('view', ['label' => 'above'])
      ->setDescription('PDF for the full text of the article.');

    // @todo Add topics field.
    return $fields;
  }

  /**
   * {@inheritdoc}
   */
  public function getLabel() {
    $pieces = [$this->brief_journal_title->value];
    $volume = $this->volume->value;
    $issue = $this->issue->value;
    $pagination = $this->pagination->value;
    if (!empty($volume)) {
      $pieces[] = $volume;
    }
    if (!empty($issue)) {
      $pieces[] = $issue;
    }
    if (!empty($pagination)) {
      $pieces[] = $pagination;
    }
    $pieces[] = $this->year->value;
    return Html::escape(implode(' ', $pieces));
  }

}
