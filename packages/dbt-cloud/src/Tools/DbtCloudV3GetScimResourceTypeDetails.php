<?php

namespace OpenCompany\Integrations\DbtCloud\Tools;

/**
 * Get SCIM Resource Type Details.
 *
 * Maps to the official dbt Cloud v3 endpoint get /api/v3/accounts/{account_id}/scim/v2/ResourceTypes/{resource_type}.
 */
class DbtCloudV3GetScimResourceTypeDetails extends AbstractDbtCloudTool
{
    protected const NAME = 'dbt_cloud_v3_get_scim_resource_type_details';
    protected const DESCRIPTION = 'Get SCIM Resource Type Details

Official dbt Cloud v3 endpoint: GET /api/v3/accounts/{account_id}/scim/v2/ResourceTypes/{resource_type}

Get Supported SCIM Resource Type Details';
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
  'resource_type' =>
  array (
    'type' => 'string',
    'description' => 'resource_type parameter.',
    'required' => true,
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/api/v3/accounts/{account_id}/scim/v2/ResourceTypes/{resource_type}';
    protected const PATH_PARAMS = array (
  'account_id' => 'account_id',
  'resource_type' => 'resource_type',
);
    protected const QUERY_PARAMS = array (
  'include_related' => 'include_related',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
