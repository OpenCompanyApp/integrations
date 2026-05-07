<?php

namespace OpenCompany\Integrations\DbtCloud\Tools;

/**
 * Assign Group Permissions.
 *
 * Maps to the official dbt Cloud v3 endpoint post /api/v3/accounts/{account_id}/group-permissions/{group_id}/.
 */
class DbtCloudV3AssignGroupPermissions extends AbstractDbtCloudTool
{
    protected const NAME = 'dbt_cloud_v3_assign_group_permissions';
    protected const DESCRIPTION = 'Assign Group Permissions

Official dbt Cloud v3 endpoint: POST /api/v3/accounts/{account_id}/group-permissions/{group_id}/';
    protected const PARAMETERS = array (
  'account_id' =>
  array (
    'type' => 'integer',
    'description' => 'account_id parameter.',
    'required' => true,
  ),
  'group_id' =>
  array (
    'type' => 'integer',
    'description' => 'group_id parameter.',
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
    protected const PATH = '/api/v3/accounts/{account_id}/group-permissions/{group_id}/';
    protected const PATH_PARAMS = array (
  'account_id' => 'account_id',
  'group_id' => 'group_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
