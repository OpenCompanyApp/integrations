<?php
namespace OpenCompany\Integrations\Featurebase\Tools;
/** Returns a list of webhooks in your organization using cursor-based pagination. */
class FeaturebaseListWebhooks extends AbstractFeaturebaseTool { protected const NAME = 'featurebase_list_webhooks'; protected const DESCRIPTION = 'Returns a list of webhooks in your organization using cursor-based pagination.'; protected const OPERATION = 'listwebhooks'; protected const PATH_PARAMS = array (
); }
