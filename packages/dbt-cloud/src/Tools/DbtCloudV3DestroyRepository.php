<?php

namespace OpenCompany\Integrations\DbtCloud\Tools;

/**
 * Destroy Repository.
 *
 * Maps to the official dbt Cloud v3 endpoint delete /api/v3/accounts/{account_id}/projects/{project_id}/repositories/{id}/.
 */
class DbtCloudV3DestroyRepository extends AbstractDbtCloudTool
{
    protected const NAME = 'dbt_cloud_v3_destroy_repository';
    protected const DESCRIPTION = 'Destroy Repository

Official dbt Cloud v3 endpoint: DELETE /api/v3/accounts/{account_id}/projects/{project_id}/repositories/{id}/

Delete a repository';
    protected const PARAMETERS = array (
  'account_id' =>
  array (
    'type' => 'integer',
    'description' => 'account_id parameter.',
    'required' => true,
  ),
  'id' =>
  array (
    'type' => 'integer',
    'description' => 'id parameter.',
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
    protected const PATH = '/api/v3/accounts/{account_id}/projects/{project_id}/repositories/{id}/';
    protected const PATH_PARAMS = array (
  'account_id' => 'account_id',
  'id' => 'id',
  'project_id' => 'project_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
