<?php

namespace OpenCompany\Integrations\DbtCloud\Tools;

/**
 * Get SCIM Group.
 *
 * Maps to the official dbt Cloud v3 endpoint get /api/v3/accounts/{account_id}/scim/v2/Groups/{group_id}.
 */
class DbtCloudV3GetScimGroup extends AbstractDbtCloudTool
{
    protected const NAME = 'dbt_cloud_v3_get_scim_group';
    protected const DESCRIPTION = 'Get SCIM Group

Official dbt Cloud v3 endpoint: GET /api/v3/accounts/{account_id}/scim/v2/Groups/{group_id}

Get a group via SCIM';
    protected const PARAMETERS = array (
  'account_id' =>
  array (
    'type' => 'integer',
    'description' => 'account_id parameter.',
    'required' => true,
  ),
  'group_id' =>
  array (
    'type' => 'string',
    'description' => 'group_id parameter.',
    'required' => true,
  ),
  'include_related' =>
  array (
    'type' => 'string',
    'description' => 'Comma-separated list of related objects to include in the response.',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/api/v3/accounts/{account_id}/scim/v2/Groups/{group_id}';
    protected const PATH_PARAMS = array (
  'account_id' => 'account_id',
  'group_id' => 'group_id',
);
    protected const QUERY_PARAMS = array (
  'include_related' => 'include_related',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
