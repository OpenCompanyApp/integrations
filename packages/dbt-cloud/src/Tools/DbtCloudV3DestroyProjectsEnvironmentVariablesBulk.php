<?php

namespace OpenCompany\Integrations\DbtCloud\Tools;

/**
 * Destroy Projects Environment Variables Bulk.
 *
 * Maps to the official dbt Cloud v3 endpoint delete /api/v3/accounts/{account_id}/projects/{project_id}/environment-variables/bulk/.
 */
class DbtCloudV3DestroyProjectsEnvironmentVariablesBulk extends AbstractDbtCloudTool
{
    protected const NAME = 'dbt_cloud_v3_destroy_projects_environment_variables_bulk';
    protected const DESCRIPTION = 'Destroy Projects Environment Variables Bulk

Official dbt Cloud v3 endpoint: DELETE /api/v3/accounts/{account_id}/projects/{project_id}/environment-variables/bulk/';
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
);
    protected const METHOD = 'delete';
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
