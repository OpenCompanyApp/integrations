<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * GetStackDriftStatus.
 *
 * Maps to the official Pulumi Cloud endpoint get /api/stacks/{orgName}/{projectName}/{stackName}/drift/status.
 */
class PulumiDeploymentsGetStackDriftStatus extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_deployments_get_stack_drift_status';
    protected const DESCRIPTION = 'GetStackDriftStatus

Official Pulumi Cloud endpoint: GET /api/stacks/{orgName}/{projectName}/{stackName}/drift/status

Retrieves the current drift detection status and associated metadata for a stack. Drift occurs when the actual state of cloud resources diverges from the state declared in the Pulumi program. The response indicates whether drift has been detected, when the last drift check was performed, and details about any detected differences. This is used in conjunction with drift detection schedules to monitor infrastructure compliance.';
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
);
    protected const METHOD = 'get';
    protected const PATH = '/api/stacks/{orgName}/{projectName}/{stackName}/drift/status';
    protected const PATH_PARAMS = array (
  'orgName' => 'org_name',
  'projectName' => 'project_name',
  'stackName' => 'stack_name',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
