<?php
namespace OpenCompany\Integrations\Featurebase\Tools;
/** Retrieves a specific redirect rule by its unique identifier. */
class FeaturebaseGetRedirectRule extends AbstractFeaturebaseTool { protected const NAME = 'featurebase_get_redirect_rule'; protected const DESCRIPTION = 'Retrieves a specific redirect rule by its unique identifier.'; protected const OPERATION = 'getredirectrule'; protected const PATH_PARAMS = array (
  0 => 'id',
); }
