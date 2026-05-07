<?php

namespace OpenCompany\Integrations\DbtCloud\Tools;

/**
 * List Webhooks Subscription Event Receipt.
 *
 * Maps to the official dbt Cloud v3 endpoint get /api/v3/accounts/{account_id}/webhooks/subscription/{subscription_id}/event/{event_id}/receipt.
 */
class DbtCloudV3ListWebhooksSubscriptionEventReceipt extends AbstractDbtCloudTool
{
    protected const NAME = 'dbt_cloud_v3_list_webhooks_subscription_event_receipt';
    protected const DESCRIPTION = 'List Webhooks Subscription Event Receipt

Official dbt Cloud v3 endpoint: GET /api/v3/accounts/{account_id}/webhooks/subscription/{subscription_id}/event/{event_id}/receipt

Get the receipt for a given subscription id and event id.
This endpoint is only used when the Notifications System is enabled, and uses Redis event history instead of the
Webhooks microservice\'s database.';
    protected const PARAMETERS = array (
  'account_id' =>
  array (
    'type' => 'integer',
    'description' => 'account_id parameter.',
    'required' => true,
  ),
  'event_id' =>
  array (
    'type' => 'string',
    'description' => 'event_id parameter.',
    'required' => true,
  ),
  'include_related' =>
  array (
    'type' => 'string',
    'description' => 'Comma-separated list of related objects to include in the response.',
  ),
  'subscription_id' =>
  array (
    'type' => 'string',
    'description' => 'subscription_id parameter.',
    'required' => true,
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/api/v3/accounts/{account_id}/webhooks/subscription/{subscription_id}/event/{event_id}/receipt';
    protected const PATH_PARAMS = array (
  'account_id' => 'account_id',
  'event_id' => 'event_id',
  'subscription_id' => 'subscription_id',
);
    protected const QUERY_PARAMS = array (
  'include_related' => 'include_related',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
