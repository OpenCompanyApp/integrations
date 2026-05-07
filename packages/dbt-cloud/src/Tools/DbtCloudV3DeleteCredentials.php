<?php

namespace OpenCompany\Integrations\DbtCloud\Tools;

/**
 * Delete Credentials.
 *
 * Maps to the official dbt Cloud v3 endpoint delete /api/v3/accounts/{account_id}/projects/{project_id}/credentials/{id}/.
 */
class DbtCloudV3DeleteCredentials extends AbstractDbtCloudTool
{
    protected const NAME = 'dbt_cloud_v3_delete_credentials';
    protected const DESCRIPTION = 'Delete Credentials

Official dbt Cloud v3 endpoint: DELETE /api/v3/accounts/{account_id}/projects/{project_id}/credentials/{id}/

Delete a set of credentials.';
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
    protected const PATH = '/api/v3/accounts/{account_id}/projects/{project_id}/credentials/{id}/';
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
