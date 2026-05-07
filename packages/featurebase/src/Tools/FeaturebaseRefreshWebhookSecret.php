<?php
namespace OpenCompany\Integrations\Featurebase\Tools;
/** Generates a new signing secret for a webhook. The previous secret is immediately invalidated. */
class FeaturebaseRefreshWebhookSecret extends AbstractFeaturebaseTool { protected const NAME = 'featurebase_refresh_webhook_secret'; protected const DESCRIPTION = 'Generates a new signing secret for a webhook. The previous secret is immediately invalidated.'; protected const OPERATION = 'refreshwebhooksecret'; protected const PATH_PARAMS = array (
  0 => 'id',
); }
