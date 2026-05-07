<?php

namespace OpenCompany\Integrations\DbtCloud\Tools;

/**
 * List User Credentials.
 *
 * Maps to the official dbt Cloud v3 endpoint get /api/v3/users/{user_id}/credentials/.
 */
class DbtCloudV3ListUserCredentials extends AbstractDbtCloudTool
{
    protected const NAME = 'dbt_cloud_v3_list_user_credentials';
    protected const DESCRIPTION = 'List User Credentials

Official dbt Cloud v3 endpoint: GET /api/v3/users/{user_id}/credentials/

List the development credentials associated with a given user.';
    protected const PARAMETERS = array (
  'include_related' =>
  array (
    'type' => 'string',
    'description' => 'Comma-separated list of related objects to include in the response. Available: credentials, project.',
  ),
  'user_id' =>
  array (
    'type' => 'integer',
    'description' => 'user_id parameter.',
    'required' => true,
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/api/v3/users/{user_id}/credentials/';
    protected const PATH_PARAMS = array (
  'user_id' => 'user_id',
);
    protected const QUERY_PARAMS = array (
  'include_related' => 'include_related',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
