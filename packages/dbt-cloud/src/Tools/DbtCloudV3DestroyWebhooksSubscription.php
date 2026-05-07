<?php

namespace OpenCompany\Integrations\DbtCloud\Tools;

/**
 * Destroy Webhooks Subscription.
 *
 * Maps to the official dbt Cloud v3 endpoint delete /api/v3/accounts/{account_id}/webhooks/subscription/{subscription_id}.
 */
class DbtCloudV3DestroyWebhooksSubscription extends AbstractDbtCloudTool
{
    protected const NAME = 'dbt_cloud_v3_destroy_webhooks_subscription';
    protected const DESCRIPTION = 'Destroy Webhooks Subscription

Official dbt Cloud v3 endpoint: DELETE /api/v3/accounts/{account_id}/webhooks/subscription/{subscription_id}

Delete a specific subscription';
    protected const PARAMETERS = array (
  'account_id' =>
  array (
    'type' => 'integer',
    'description' => 'account_id parameter.',
    'required' => true,
  ),
  'subscription_id' =>
  array (
    'type' => 'string',
    'description' => 'subscription_id parameter.',
    'required' => true,
  ),
);
    protected const METHOD = 'delete';
    protected const PATH = '/api/v3/accounts/{account_id}/webhooks/subscription/{subscription_id}';
    protected const PATH_PARAMS = array (
  'account_id' => 'account_id',
  'subscription_id' => 'subscription_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
