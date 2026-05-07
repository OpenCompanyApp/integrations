<?php

namespace OpenCompany\Integrations\DbtCloud\Tools;

/**
 * Update Credentials.
 *
 * Maps to the official dbt Cloud v3 endpoint post /api/v3/accounts/{account_id}/projects/{project_id}/credentials/{id}/.
 */
class DbtCloudV3UpdateCredentials extends AbstractDbtCloudTool
{
    protected const NAME = 'dbt_cloud_v3_update_credentials';
    protected const DESCRIPTION = 'Update Credentials

Official dbt Cloud v3 endpoint: POST /api/v3/accounts/{account_id}/projects/{project_id}/credentials/{id}/

Update a set of credentials.';
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
  'body' =>
  array (
    'type' => 'object',
    'description' => 'JSON request body matching the dbt Cloud API schema.',
  ),
);
    protected const METHOD = 'post';
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
