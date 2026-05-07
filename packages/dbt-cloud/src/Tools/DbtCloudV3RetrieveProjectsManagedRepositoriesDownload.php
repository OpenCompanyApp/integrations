<?php

namespace OpenCompany\Integrations\DbtCloud\Tools;

/**
 * Retrieve Projects Managed Repositories Download.
 *
 * Maps to the official dbt Cloud v3 endpoint get /api/v3/accounts/{account_id}/projects/{project_id}/managed-repositories/{repository_id}/download/.
 */
class DbtCloudV3RetrieveProjectsManagedRepositoriesDownload extends AbstractDbtCloudTool
{
    protected const NAME = 'dbt_cloud_v3_retrieve_projects_managed_repositories_download';
    protected const DESCRIPTION = 'Retrieve Projects Managed Repositories Download

Official dbt Cloud v3 endpoint: GET /api/v3/accounts/{account_id}/projects/{project_id}/managed-repositories/{repository_id}/download/

Download a managed repository as a ZIP archive';
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
  'repository_id' =>
  array (
    'type' => 'integer',
    'description' => 'repository_id parameter.',
    'required' => true,
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/api/v3/accounts/{account_id}/projects/{project_id}/managed-repositories/{repository_id}/download/';
    protected const PATH_PARAMS = array (
  'account_id' => 'account_id',
  'project_id' => 'project_id',
  'repository_id' => 'repository_id',
);
    protected const QUERY_PARAMS = array (
  'include_related' => 'include_related',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
