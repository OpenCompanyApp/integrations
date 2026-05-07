<?php

namespace OpenCompany\Integrations\DbtCloud\Tools;

/**
 * List Webhooks Events.
 *
 * Maps to the official dbt Cloud v3 endpoint get /api/v3/accounts/{account_id}/webhooks/subscription/{subscription_id}/events.
 */
class DbtCloudV3ListWebhooksEvents extends AbstractDbtCloudTool
{
    protected const NAME = 'dbt_cloud_v3_list_webhooks_events';
    protected const DESCRIPTION = 'List Webhooks Events

Official dbt Cloud v3 endpoint: GET /api/v3/accounts/{account_id}/webhooks/subscription/{subscription_id}/events

Get all events for a specific subscription';
    protected const PARAMETERS = array (
  'account_id' =>
  array (
    'type' => 'integer',
    'description' => 'account_id parameter.',
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
    protected const PATH = '/api/v3/accounts/{account_id}/webhooks/subscription/{subscription_id}/events';
    protected const PATH_PARAMS = array (
  'account_id' => 'account_id',
  'subscription_id' => 'subscription_id',
);
    protected const QUERY_PARAMS = array (
  'include_related' => 'include_related',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
