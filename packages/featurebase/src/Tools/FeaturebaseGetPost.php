<?php
namespace OpenCompany\Integrations\Featurebase\Tools;
/** Retrieves a single post by its unique identifier. */
class FeaturebaseGetPost extends AbstractFeaturebaseTool { protected const NAME = 'featurebase_get_post'; protected const DESCRIPTION = 'Retrieves a single post by its unique identifier.'; protected const OPERATION = 'getpost'; protected const PATH_PARAMS = array (
  0 => 'id',
); }
