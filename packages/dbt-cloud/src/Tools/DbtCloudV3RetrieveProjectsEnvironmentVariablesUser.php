<?php

namespace OpenCompany\Integrations\DbtCloud\Tools;

/**
 * Retrieve Projects Environment Variables User.
 *
 * Maps to the official dbt Cloud v3 endpoint get /api/v3/accounts/{account_id}/projects/{project_id}/environment-variables/user/.
 */
class DbtCloudV3RetrieveProjectsEnvironmentVariablesUser extends AbstractDbtCloudTool
{
    protected const NAME = 'dbt_cloud_v3_retrieve_projects_environment_variables_user';
    protected const DESCRIPTION = 'Retrieve Projects Environment Variables User

Official dbt Cloud v3 endpoint: GET /api/v3/accounts/{account_id}/projects/{project_id}/environment-variables/user/';
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
  'project_id' =>
  array (
    'type' => 'integer',
    'description' => 'project_id parameter.',
    'required' => true,
  ),
  'user_id' =>
  array (
    'type' => 'integer',
    'description' => 'The ID of the user to retrieve environment variables for',
    'required' => true,
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/api/v3/accounts/{account_id}/projects/{project_id}/environment-variables/user/';
    protected const PATH_PARAMS = array (
  'account_id' => 'account_id',
  'project_id' => 'project_id',
);
    protected const QUERY_PARAMS = array (
  'include_related' => 'include_related',
  'user_id' => 'user_id',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
