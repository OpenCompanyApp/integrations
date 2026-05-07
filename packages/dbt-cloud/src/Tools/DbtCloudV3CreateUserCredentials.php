<?php

namespace OpenCompany\Integrations\DbtCloud\Tools;

/**
 * Create User Credentials.
 *
 * Maps to the official dbt Cloud v3 endpoint post /api/v3/users/{user_id}/credentials/.
 */
class DbtCloudV3CreateUserCredentials extends AbstractDbtCloudTool
{
    protected const NAME = 'dbt_cloud_v3_create_user_credentials';
    protected const DESCRIPTION = 'Create User Credentials

Official dbt Cloud v3 endpoint: POST /api/v3/users/{user_id}/credentials/

Associate a set of development credentials with a given user.';
    protected const PARAMETERS = array (
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
    protected const PATH = '/api/v3/users/{user_id}/credentials/';
    protected const PATH_PARAMS = array (
  'user_id' => 'user_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
