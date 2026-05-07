<?php

namespace OpenCompany\Integrations\DbtCloud\Tools;

/**
 * Retrieve Webhooks Receipt.
 *
 * Maps to the official dbt Cloud v3 endpoint get /api/v3/accounts/{account_id}/webhooks/receipt/{receipt_id}.
 */
class DbtCloudV3RetrieveWebhooksReceipt extends AbstractDbtCloudTool
{
    protected const NAME = 'dbt_cloud_v3_retrieve_webhooks_receipt';
    protected const DESCRIPTION = 'Retrieve Webhooks Receipt

Official dbt Cloud v3 endpoint: GET /api/v3/accounts/{account_id}/webhooks/receipt/{receipt_id}

Get a specific receipt given its id.
This endpoint is deprecated and should not be called anymore.';
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
  'receipt_id' =>
  array (
    'type' => 'string',
    'description' => 'receipt_id parameter.',
    'required' => true,
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/api/v3/accounts/{account_id}/webhooks/receipt/{receipt_id}';
    protected const PATH_PARAMS = array (
  'account_id' => 'account_id',
  'receipt_id' => 'receipt_id',
);
    protected const QUERY_PARAMS = array (
  'include_related' => 'include_related',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
