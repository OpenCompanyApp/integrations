<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * GetDeploymentLogs.
 *
 * Maps to the official Pulumi Cloud endpoint get /api/stacks/{orgName}/{projectName}/{stackName}/deployments/{deploymentId}/logs.
 */
class PulumiDeploymentsGetDeploymentLogs extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_deployments_get_deployment_logs';
    protected const DESCRIPTION = 'GetDeploymentLogs

Official Pulumi Cloud endpoint: GET /api/stacks/{orgName}/{projectName}/{stackName}/deployments/{deploymentId}/logs

Retrieves execution logs for a Pulumi Deployments run. Supports two retrieval modes: streaming mode and step mode. In streaming mode, omit job/step parameters and use the continuationToken to incrementally fetch logs from the beginning through completion. Each response includes a nextToken field; continue requesting with this token until nextToken is absent, indicating all logs have been retrieved. In step mode, specify job and step indices to retrieve logs for a specific step within a specific job, with offset and count parameters for pagination within that step\'s logs. In step mode, count must be between 1 and 499 (default 100), and the response includes a nextOffset field for fetching subsequent pages. Log lines include timestamps and the log line content. Note that this serves two endpoints: - /{orgName}/{projectName}/{stackName}/deployments/{deploymentId}/logs - /admin/deployment...';
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
  'deployment_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `deploymentId` from the official Pulumi Cloud API operation. The deployment identifier',
  ),
  'continuation_token' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `continuationToken` from the official Pulumi Cloud API operation. Continuation token for streaming logs; use nextToken from the previous response to fetch subsequent log entries',
  ),
  'count' =>
  array (
    'type' => 'integer',
    'required' => false,
    'description' => 'Query parameter `count` from the official Pulumi Cloud API operation. Number of log lines to return (1-499, default 100)',
  ),
  'job' =>
  array (
    'type' => 'integer',
    'required' => false,
    'description' => 'Query parameter `job` from the official Pulumi Cloud API operation. Zero-based job index to retrieve logs for',
  ),
  'offset' =>
  array (
    'type' => 'integer',
    'required' => false,
    'description' => 'Query parameter `offset` from the official Pulumi Cloud API operation. Zero-based line offset within the step logs',
  ),
  'step' =>
  array (
    'type' => 'integer',
    'required' => false,
    'description' => 'Query parameter `step` from the official Pulumi Cloud API operation. Zero-based step index within the specified job',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/api/stacks/{orgName}/{projectName}/{stackName}/deployments/{deploymentId}/logs';
    protected const PATH_PARAMS = array (
  'orgName' => 'org_name',
  'projectName' => 'project_name',
  'stackName' => 'stack_name',
  'deploymentId' => 'deployment_id',
);
    protected const QUERY_PARAMS = array (
  'continuationToken' => 'continuation_token',
  'count' => 'count',
  'job' => 'job',
  'offset' => 'offset',
  'step' => 'step',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
