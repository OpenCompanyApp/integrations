<?php

namespace OpenCompany\Integrations\DbtCloud\Tools;

/**
 * Update Webhooks Subscription.
 *
 * Maps to the official dbt Cloud v3 endpoint put /api/v3/accounts/{account_id}/webhooks/subscription/{subscription_id}.
 */
class DbtCloudV3UpdateWebhooksSubscription extends AbstractDbtCloudTool
{
    protected const NAME = 'dbt_cloud_v3_update_webhooks_subscription';
    protected const DESCRIPTION = 'Update Webhooks Subscription

Official dbt Cloud v3 endpoint: PUT /api/v3/accounts/{account_id}/webhooks/subscription/{subscription_id}

Edit a subscription given a subscription id';
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
  'body' =>
  array (
    'type' => 'object',
    'description' => 'JSON request body matching the dbt Cloud API schema.',
    'required' => true,
  ),
);
    protected const METHOD = 'put';
    protected const PATH = '/api/v3/accounts/{account_id}/webhooks/subscription/{subscription_id}';
    protected const PATH_PARAMS = array (
  'account_id' => 'account_id',
  'subscription_id' => 'subscription_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
