<?php

namespace OpenCompany\Integrations\DbtCloud\Tools;

/**
 * List Webhooks Subscriptions.
 *
 * Maps to the official dbt Cloud v3 endpoint get /api/v3/accounts/{account_id}/webhooks/subscriptions.
 */
class DbtCloudV3ListWebhooksSubscriptions extends AbstractDbtCloudTool
{
    protected const NAME = 'dbt_cloud_v3_list_webhooks_subscriptions';
    protected const DESCRIPTION = 'List Webhooks Subscriptions

Official dbt Cloud v3 endpoint: GET /api/v3/accounts/{account_id}/webhooks/subscriptions

Given an account id list all webhook subscriptions';
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
  'limit' =>
  array (
    'type' => 'integer',
    'description' => 'The maximum number of items to return.',
  ),
  'offset' =>
  array (
    'type' => 'integer',
    'description' => 'The number of items to skip before starting to collect the result set.',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/api/v3/accounts/{account_id}/webhooks/subscriptions';
    protected const PATH_PARAMS = array (
  'account_id' => 'account_id',
);
    protected const QUERY_PARAMS = array (
  'include_related' => 'include_related',
  'limit' => 'limit',
  'offset' => 'offset',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
