<?php

namespace OpenCompany\Integrations\DbtCloud\Tools;

/**
 * List SCIM Groups.
 *
 * Maps to the official dbt Cloud v3 endpoint get /api/v3/accounts/{account_id}/scim/v2/Groups.
 */
class DbtCloudV3ListScimGroups extends AbstractDbtCloudTool
{
    protected const NAME = 'dbt_cloud_v3_list_scim_groups';
    protected const DESCRIPTION = 'List SCIM Groups

Official dbt Cloud v3 endpoint: GET /api/v3/accounts/{account_id}/scim/v2/Groups

List all groups via SCIM';
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
    protected const PATH = '/api/v3/accounts/{account_id}/scim/v2/Groups';
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
