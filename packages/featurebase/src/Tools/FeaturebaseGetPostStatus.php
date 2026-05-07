<?php
namespace OpenCompany\Integrations\Featurebase\Tools;
/** Retrieves a single post status by its unique identifier. */
class FeaturebaseGetPostStatus extends AbstractFeaturebaseTool { protected const NAME = 'featurebase_get_post_status'; protected const DESCRIPTION = 'Retrieves a single post status by its unique identifier.'; protected const OPERATION = 'getpoststatus'; protected const PATH_PARAMS = array (
  0 => 'id',
); }
