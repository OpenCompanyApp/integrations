<?php

namespace OpenCompany\Integrations\DbtCloud\Tools;

/**
 * Update Lineage Integration.
 *
 * Maps to the official dbt Cloud v3 endpoint patch /api/v3/accounts/{account_id}/projects/{project_id}/integrations/lineage/{id}/.
 */
class DbtCloudV3UpdateLineageIntegration extends AbstractDbtCloudTool
{
    protected const NAME = 'dbt_cloud_v3_update_lineage_integration';
    protected const DESCRIPTION = 'Update Lineage Integration

Official dbt Cloud v3 endpoint: PATCH /api/v3/accounts/{account_id}/projects/{project_id}/integrations/lineage/{id}/';
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
    protected const METHOD = 'patch';
    protected const PATH = '/api/v3/accounts/{account_id}/projects/{project_id}/integrations/lineage/{id}/';
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
