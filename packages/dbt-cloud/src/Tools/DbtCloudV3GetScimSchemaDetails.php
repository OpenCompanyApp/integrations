<?php

namespace OpenCompany\Integrations\DbtCloud\Tools;

/**
 * Get SCIM Schema Details.
 *
 * Maps to the official dbt Cloud v3 endpoint get /api/v3/accounts/{account_id}/scim/v2/Schemas/{schema_uri}.
 */
class DbtCloudV3GetScimSchemaDetails extends AbstractDbtCloudTool
{
    protected const NAME = 'dbt_cloud_v3_get_scim_schema_details';
    protected const DESCRIPTION = 'Get SCIM Schema Details

Official dbt Cloud v3 endpoint: GET /api/v3/accounts/{account_id}/scim/v2/Schemas/{schema_uri}

Get Supported SCIM Schema Details';
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
  'schema_uri' =>
  array (
    'type' => 'string',
    'description' => 'schema_uri parameter.',
    'required' => true,
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/api/v3/accounts/{account_id}/scim/v2/Schemas/{schema_uri}';
    protected const PATH_PARAMS = array (
  'account_id' => 'account_id',
  'schema_uri' => 'schema_uri',
);
    protected const QUERY_PARAMS = array (
  'include_related' => 'include_related',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
