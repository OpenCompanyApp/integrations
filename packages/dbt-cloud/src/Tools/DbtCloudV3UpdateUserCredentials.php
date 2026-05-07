<?php

namespace OpenCompany\Integrations\DbtCloud\Tools;

/**
 * Update User Credentials.
 *
 * Maps to the official dbt Cloud v3 endpoint post /api/v3/users/{user_id}/credentials/{id}/.
 */
class DbtCloudV3UpdateUserCredentials extends AbstractDbtCloudTool
{
    protected const NAME = 'dbt_cloud_v3_update_user_credentials';
    protected const DESCRIPTION = 'Update User Credentials

Official dbt Cloud v3 endpoint: POST /api/v3/users/{user_id}/credentials/{id}/

Update which development credentials are associated with a specific user.';
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
  'body' =>
  array (
    'type' => 'object',
    'description' => 'JSON request body matching the dbt Cloud API schema.',
    'required' => true,
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/api/v3/users/{user_id}/credentials/{id}/';
    protected const PATH_PARAMS = array (
  'id' => 'id',
  'user_id' => 'user_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
