<?php
namespace OpenCompany\Integrations\Featurebase\Tools;
/** Deletes an existing redirect rule. The associated Redis cache entry is also invalidated. */
class FeaturebaseDeleteRedirectRule extends AbstractFeaturebaseTool { protected const NAME = 'featurebase_delete_redirect_rule'; protected const DESCRIPTION = 'Deletes an existing redirect rule. The associated Redis cache entry is also invalidated.'; protected const OPERATION = 'deleteredirectrule'; protected const PATH_PARAMS = array (
  0 => 'id',
); }
