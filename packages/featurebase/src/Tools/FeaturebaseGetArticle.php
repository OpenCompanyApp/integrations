<?php
namespace OpenCompany\Integrations\Featurebase\Tools;
/** Retrieves a specific article by its unique identifier. */
class FeaturebaseGetArticle extends AbstractFeaturebaseTool { protected const NAME = 'featurebase_get_article'; protected const DESCRIPTION = 'Retrieves a specific article by its unique identifier.'; protected const OPERATION = 'getarticle'; protected const PATH_PARAMS = array (
  0 => 'id',
); }
