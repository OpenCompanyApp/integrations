<?php

namespace OpenCompany\Integrations\DbtCloud\Tools;

/**
 * Delete SCIM Group.
 *
 * Maps to the official dbt Cloud v3 endpoint delete /api/v3/accounts/{account_id}/scim/v2/Groups/{group_id}.
 */
class DbtCloudV3DeleteScimGroup extends AbstractDbtCloudTool
{
    protected const NAME = 'dbt_cloud_v3_delete_scim_group';
    protected const DESCRIPTION = 'Delete SCIM Group

Official dbt Cloud v3 endpoint: DELETE /api/v3/accounts/{account_id}/scim/v2/Groups/{group_id}

Delete a group via SCIM';
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
);
    protected const METHOD = 'delete';
    protected const PATH = '/api/v3/accounts/{account_id}/scim/v2/Groups/{group_id}';
    protected const PATH_PARAMS = array (
  'account_id' => 'account_id',
  'group_id' => 'group_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
