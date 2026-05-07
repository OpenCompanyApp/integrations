<?php
namespace OpenCompany\Integrations\Featurebase\Tools;
/** Deletes an existing article. */
class FeaturebaseDeleteArticle extends AbstractFeaturebaseTool { protected const NAME = 'featurebase_delete_article'; protected const DESCRIPTION = 'Deletes an existing article.'; protected const OPERATION = 'deletearticle'; protected const PATH_PARAMS = array (
  0 => 'id',
); }
