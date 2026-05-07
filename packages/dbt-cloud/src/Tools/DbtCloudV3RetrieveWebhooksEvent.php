<?php

namespace OpenCompany\Integrations\DbtCloud\Tools;

/**
 * Retrieve Webhooks Event.
 *
 * Maps to the official dbt Cloud v3 endpoint get /api/v3/accounts/{account_id}/webhooks/event/{event_id}.
 */
class DbtCloudV3RetrieveWebhooksEvent extends AbstractDbtCloudTool
{
    protected const NAME = 'dbt_cloud_v3_retrieve_webhooks_event';
    protected const DESCRIPTION = 'Retrieve Webhooks Event

Official dbt Cloud v3 endpoint: GET /api/v3/accounts/{account_id}/webhooks/event/{event_id}

Get a specific event given an event_id.
This endpoint is deprecated and should not be called anymore.';
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
);
    protected const METHOD = 'get';
    protected const PATH = '/api/v3/accounts/{account_id}/webhooks/event/{event_id}';
    protected const PATH_PARAMS = array (
  'account_id' => 'account_id',
  'event_id' => 'event_id',
);
    protected const QUERY_PARAMS = array (
  'include_related' => 'include_related',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
