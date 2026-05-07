<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * ListStackDeploymentsHandlerV2.
 *
 * Maps to the official Pulumi Cloud endpoint get /api/stacks/{orgName}/{projectName}/{stackName}/deployments.
 */
class PulumiDeploymentsListStackDeploymentsHandlerV2 extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_deployments_list_stack_deployments_handler_v2';
    protected const DESCRIPTION = 'ListStackDeploymentsHandlerV2

Official Pulumi Cloud endpoint: GET /api/stacks/{orgName}/{projectName}/{stackName}/deployments

Returns a paginated list of Pulumi Deployments executions for a specific stack. The response includes each deployment\'s ID, status, version, creation and modification timestamps, the requesting user, Pulumi operation type, job details with step-level progress, and associated stack update results. Use \'page\' (minimum 1, default 1) and \'pageSize\' (1-100, default 10) for pagination, \'sort\' to specify the sort field, and \'asc\' to control sort direction (default descending). The response also includes the total count of deployments for the stack.';
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
  'asc' =>
  array (
    'type' => 'boolean',
    'required' => false,
    'description' => 'Query parameter `asc` from the official Pulumi Cloud API operation. Sort in ascending order when true (default false)',
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
  'sort' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `sort` from the official Pulumi Cloud API operation. Field to sort results by',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/api/stacks/{orgName}/{projectName}/{stackName}/deployments';
    protected const PATH_PARAMS = array (
  'orgName' => 'org_name',
  'projectName' => 'project_name',
  'stackName' => 'stack_name',
);
    protected const QUERY_PARAMS = array (
  'asc' => 'asc',
  'page' => 'page',
  'pageSize' => 'page_size',
  'sort' => 'sort',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
