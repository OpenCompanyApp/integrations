<?php

namespace OpenCompany\Integrations\DbtCloud\Tools;

/**
 * Delete SCIM User.
 *
 * Maps to the official dbt Cloud v3 endpoint delete /api/v3/accounts/{account_id}/scim/v2/Users/{user_id}.
 */
class DbtCloudV3DeleteScimUser extends AbstractDbtCloudTool
{
    protected const NAME = 'dbt_cloud_v3_delete_scim_user';
    protected const DESCRIPTION = 'Delete SCIM User

Official dbt Cloud v3 endpoint: DELETE /api/v3/accounts/{account_id}/scim/v2/Users/{user_id}

Delete a user via SCIM. This endpoint will remove the users license from the account.';
    protected const PARAMETERS = array (
  'account_id' =>
  array (
    'type' => 'integer',
    'description' => 'account_id parameter.',
    'required' => true,
  ),
  'user_id' =>
  array (
    'type' => 'string',
    'description' => 'user_id parameter.',
    'required' => true,
  ),
);
    protected const METHOD = 'delete';
    protected const PATH = '/api/v3/accounts/{account_id}/scim/v2/Users/{user_id}';
    protected const PATH_PARAMS = array (
  'account_id' => 'account_id',
  'user_id' => 'user_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
