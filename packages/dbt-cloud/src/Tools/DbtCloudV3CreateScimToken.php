<?php

namespace OpenCompany\Integrations\DbtCloud\Tools;

/**
 * Create SCIM token.
 *
 * Maps to the official dbt Cloud v3 endpoint post /api/v3/accounts/{account_id}/scim-config/tokens/.
 */
class DbtCloudV3CreateScimToken extends AbstractDbtCloudTool
{
    protected const NAME = 'dbt_cloud_v3_create_scim_token';
    protected const DESCRIPTION = 'Create SCIM token

Official dbt Cloud v3 endpoint: POST /api/v3/accounts/{account_id}/scim-config/tokens/

Create a SCIM token';
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
    protected const PATH = '/api/v3/accounts/{account_id}/scim-config/tokens/';
    protected const PATH_PARAMS = array (
  'account_id' => 'account_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
