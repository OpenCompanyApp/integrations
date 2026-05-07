<?php

namespace OpenCompany\Integrations\DbtCloud\Tools;

/**
 * Create Project.
 *
 * Maps to the official dbt Cloud v3 endpoint post /api/v3/accounts/{account_id}/projects/.
 */
class DbtCloudV3CreateProject extends AbstractDbtCloudTool
{
    protected const NAME = 'dbt_cloud_v3_create_project';
    protected const DESCRIPTION = 'Create Project

Official dbt Cloud v3 endpoint: POST /api/v3/accounts/{account_id}/projects/

Create a new Project';
    protected const PARAMETERS = array (
  'account_id' =>
  array (
    'type' => 'integer',
    'description' => 'account_id parameter.',
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
    protected const PATH = '/api/v3/accounts/{account_id}/projects/';
    protected const PATH_PARAMS = array (
  'account_id' => 'account_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
