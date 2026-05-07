<?php

namespace OpenCompany\Integrations\DbtCloud\Tools;

/**
 * Update Projects Environment Variables Bulk.
 *
 * Maps to the official dbt Cloud v3 endpoint put /api/v3/accounts/{account_id}/projects/{project_id}/environment-variables/bulk/.
 */
class DbtCloudV3UpdateProjectsEnvironmentVariablesBulk extends AbstractDbtCloudTool
{
    protected const NAME = 'dbt_cloud_v3_update_projects_environment_variables_bulk';
    protected const DESCRIPTION = 'Update Projects Environment Variables Bulk

Official dbt Cloud v3 endpoint: PUT /api/v3/accounts/{account_id}/projects/{project_id}/environment-variables/bulk/';
    protected const PARAMETERS = array (
  'account_id' =>
  array (
    'type' => 'integer',
    'description' => 'account_id parameter.',
    'required' => true,
  ),
  'project_id' =>
  array (
    'type' => 'integer',
    'description' => 'project_id parameter.',
    'required' => true,
  ),
  'body' =>
  array (
    'type' => 'object',
    'description' => 'JSON request body matching the dbt Cloud API schema.',
  ),
);
    protected const METHOD = 'put';
    protected const PATH = '/api/v3/accounts/{account_id}/projects/{project_id}/environment-variables/bulk/';
    protected const PATH_PARAMS = array (
  'account_id' => 'account_id',
  'project_id' => 'project_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
