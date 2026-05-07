<?php

namespace OpenCompany\Integrations\DbtCloud\Tools;

/**
 * Get SCIM Resource Types.
 *
 * Maps to the official dbt Cloud v3 endpoint get /api/v3/accounts/{account_id}/scim/v2/ResourceTypes.
 */
class DbtCloudV3GetScimResourceTypes extends AbstractDbtCloudTool
{
    protected const NAME = 'dbt_cloud_v3_get_scim_resource_types';
    protected const DESCRIPTION = 'Get SCIM Resource Types

Official dbt Cloud v3 endpoint: GET /api/v3/accounts/{account_id}/scim/v2/ResourceTypes

Get Supported SCIM Resource Types';
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
    protected const PATH = '/api/v3/accounts/{account_id}/scim/v2/ResourceTypes';
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
