<?php

namespace OpenCompany\Integrations\DbtCloud\Tools;

/**
 * Create Service Token.
 *
 * Maps to the official dbt Cloud v3 endpoint post /api/v3/accounts/{account_id}/service-tokens/.
 */
class DbtCloudV3CreateServiceToken extends AbstractDbtCloudTool
{
    protected const NAME = 'dbt_cloud_v3_create_service_token';
    protected const DESCRIPTION = 'Create Service Token

Official dbt Cloud v3 endpoint: POST /api/v3/accounts/{account_id}/service-tokens/

This endpoint is used to generate a new service token for the account.';
    protected const PARAMETERS = array (
  'account_id' =>
  array (
    'type' => 'integer',
    'description' => 'account_id parameter.',
    'required' => true,
  ),
  'body' =>
  array (
    'type' => 'object',
    'description' => 'JSON request body matching the dbt Cloud API schema.',
    'required' => true,
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/api/v3/accounts/{account_id}/service-tokens/';
    protected const PATH_PARAMS = array (
  'account_id' => 'account_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
