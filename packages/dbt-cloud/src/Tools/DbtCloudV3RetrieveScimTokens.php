<?php

namespace OpenCompany\Integrations\DbtCloud\Tools;

/**
 * Retrieve SCIM tokens.
 *
 * Maps to the official dbt Cloud v3 endpoint get /api/v3/accounts/{account_id}/scim-config/tokens/.
 */
class DbtCloudV3RetrieveScimTokens extends AbstractDbtCloudTool
{
    protected const NAME = 'dbt_cloud_v3_retrieve_scim_tokens';
    protected const DESCRIPTION = 'Retrieve SCIM tokens

Official dbt Cloud v3 endpoint: GET /api/v3/accounts/{account_id}/scim-config/tokens/

Retrieve all SCIM tokens';
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
    protected const PATH = '/api/v3/accounts/{account_id}/scim-config/tokens/';
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
