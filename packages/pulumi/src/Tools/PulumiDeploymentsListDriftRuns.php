<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * ListDriftRuns.
 *
 * Maps to the official Pulumi Cloud endpoint get /api/stacks/{orgName}/{projectName}/{stackName}/drift/runs.
 */
class PulumiDeploymentsListDriftRuns extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_deployments_list_drift_runs';
    protected const DESCRIPTION = 'ListDriftRuns

Official Pulumi Cloud endpoint: GET /api/stacks/{orgName}/{projectName}/{stackName}/drift/runs

Returns a paginated list of all drift detection runs for a stack. Each drift run represents a scheduled or manually triggered drift detection execution and includes details about whether drift was detected and any remediation actions taken. Use the \'page\' (minimum 1, default 1) and \'pageSize\' (1-100, default 10) query parameters for pagination.';
    protected const PARAMETERS = array (
  'org_name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `orgName` from the official Pulumi Cloud API operation. The organization name',
  ),
  'project_name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `projectName` from the official Pulumi Cloud API operation. The project name',
  ),
  'stack_name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `stackName` from the official Pulumi Cloud API operation. The stack name',
  ),
  'page' =>
  array (
    'type' => 'integer',
    'required' => false,
    'description' => 'Query parameter `page` from the official Pulumi Cloud API operation. Page number (min 1, default 1)',
  ),
  'page_size' =>
  array (
    'type' => 'integer',
    'required' => false,
    'description' => 'Query parameter `pageSize` from the official Pulumi Cloud API operation. Results per page (1-100, default 10)',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/api/stacks/{orgName}/{projectName}/{stackName}/drift/runs';
    protected const PATH_PARAMS = array (
  'orgName' => 'org_name',
  'projectName' => 'project_name',
  'stackName' => 'stack_name',
);
    protected const QUERY_PARAMS = array (
  'page' => 'page',
  'pageSize' => 'page_size',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
