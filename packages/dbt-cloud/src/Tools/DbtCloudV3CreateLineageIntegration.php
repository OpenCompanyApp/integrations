<?php

namespace OpenCompany\Integrations\DbtCloud\Tools;

/**
 * Create Lineage Integration.
 *
 * Maps to the official dbt Cloud v3 endpoint post /api/v3/accounts/{account_id}/projects/{project_id}/integrations/lineage/.
 */
class DbtCloudV3CreateLineageIntegration extends AbstractDbtCloudTool
{
    protected const NAME = 'dbt_cloud_v3_create_lineage_integration';
    protected const DESCRIPTION = 'Create Lineage Integration

Official dbt Cloud v3 endpoint: POST /api/v3/accounts/{account_id}/projects/{project_id}/integrations/lineage/';
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
    'required' => true,
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/api/v3/accounts/{account_id}/projects/{project_id}/integrations/lineage/';
    protected const PATH_PARAMS = array (
  'account_id' => 'account_id',
  'project_id' => 'project_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
