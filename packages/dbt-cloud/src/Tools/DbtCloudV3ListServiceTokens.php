<?php

namespace OpenCompany\Integrations\DbtCloud\Tools;

/**
 * List Service Tokens.
 *
 * Maps to the official dbt Cloud v3 endpoint get /api/v3/accounts/{account_id}/service-tokens/.
 */
class DbtCloudV3ListServiceTokens extends AbstractDbtCloudTool
{
    protected const NAME = 'dbt_cloud_v3_list_service_tokens';
    protected const DESCRIPTION = 'List Service Tokens

Official dbt Cloud v3 endpoint: GET /api/v3/accounts/{account_id}/service-tokens/';
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
);
    protected const METHOD = 'get';
    protected const PATH = '/api/v3/accounts/{account_id}/service-tokens/';
    protected const PATH_PARAMS = array (
  'account_id' => 'account_id',
);
    protected const QUERY_PARAMS = array (
  'include_related' => 'include_related',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
