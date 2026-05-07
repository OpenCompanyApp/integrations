<?php
namespace OpenCompany\Integrations\Featurebase\Tools;
/** Updates an existing redirect rule. Only include the fields you wish to update. */
class FeaturebaseUpdateRedirectRule extends AbstractFeaturebaseTool { protected const NAME = 'featurebase_update_redirect_rule'; protected const DESCRIPTION = 'Updates an existing redirect rule. Only include the fields you wish to update.'; protected const OPERATION = 'updateredirectrule'; protected const PATH_PARAMS = array (
  0 => 'id',
); }
