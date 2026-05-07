<?php

namespace OpenCompany\Integrations\DbtCloud\Tools;

/**
 * Delete User Credentials.
 *
 * Maps to the official dbt Cloud v3 endpoint delete /api/v3/users/{user_id}/credentials/{id}/.
 */
class DbtCloudV3DeleteUserCredentials extends AbstractDbtCloudTool
{
    protected const NAME = 'dbt_cloud_v3_delete_user_credentials';
    protected const DESCRIPTION = 'Delete User Credentials

Official dbt Cloud v3 endpoint: DELETE /api/v3/users/{user_id}/credentials/{id}/

Delete a development credentials / user association.';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'integer',
    'description' => 'id parameter.',
    'required' => true,
  ),
  'user_id' =>
  array (
    'type' => 'integer',
    'description' => 'user_id parameter.',
    'required' => true,
  ),
);
    protected const METHOD = 'delete';
    protected const PATH = '/api/v3/users/{user_id}/credentials/{id}/';
    protected const PATH_PARAMS = array (
  'id' => 'id',
  'user_id' => 'user_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
