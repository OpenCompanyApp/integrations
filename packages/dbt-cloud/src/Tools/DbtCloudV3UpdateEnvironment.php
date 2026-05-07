<?php

namespace OpenCompany\Integrations\DbtCloud\Tools;

/**
 * Update Environment.
 *
 * Maps to the official dbt Cloud v3 endpoint post /api/v3/accounts/{account_id}/projects/{project_id}/environments/{id}/.
 */
class DbtCloudV3UpdateEnvironment extends AbstractDbtCloudTool
{
    protected const NAME = 'dbt_cloud_v3_update_environment';
    protected const DESCRIPTION = 'Update Environment

Official dbt Cloud v3 endpoint: POST /api/v3/accounts/{account_id}/projects/{project_id}/environments/{id}/

Replace an Environment. This is a full replace operation — all fields must be provided. Any omitted fields will be reset to their default values (typically null). To avoid unintentionally clearing fields such as credentials_id or connection_id, first retrieve the environment with a GET request and include all current values in the update payload.';
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
    'required' => true,
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/api/v3/accounts/{account_id}/projects/{project_id}/environments/{id}/';
    protected const PATH_PARAMS = array (
  'account_id' => 'account_id',
  'id' => 'id',
  'project_id' => 'project_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
