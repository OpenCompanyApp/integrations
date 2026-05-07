<?php

namespace OpenCompany\Integrations\DbtCloud\Tools;

/**
 * Retrieve SCIM configuration.
 *
 * Maps to the official dbt Cloud v3 endpoint get /api/v3/accounts/{account_id}/scim-config/.
 */
class DbtCloudV3RetrieveScimConfiguration extends AbstractDbtCloudTool
{
    protected const NAME = 'dbt_cloud_v3_retrieve_scim_configuration';
    protected const DESCRIPTION = 'Retrieve SCIM configuration

Official dbt Cloud v3 endpoint: GET /api/v3/accounts/{account_id}/scim-config/

Retrieve the SCIM configuration for the account';
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
    protected const PATH = '/api/v3/accounts/{account_id}/scim-config/';
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
