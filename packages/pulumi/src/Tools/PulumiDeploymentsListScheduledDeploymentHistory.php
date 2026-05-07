<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * ListScheduledDeploymentHistory.
 *
 * Maps to the official Pulumi Cloud endpoint get /api/stacks/{orgName}/{projectName}/{stackName}/deployments/schedules/{scheduleID}/history.
 */
class PulumiDeploymentsListScheduledDeploymentHistory extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_deployments_list_scheduled_deployment_history';
    protected const DESCRIPTION = 'ListScheduledDeploymentHistory

Official Pulumi Cloud endpoint: GET /api/stacks/{orgName}/{projectName}/{stackName}/deployments/schedules/{scheduleID}/history

Returns the execution history for a specific scheduled deployment action. The response includes a chronological list of past schedule invocations and their outcomes, such as whether the triggered deployment succeeded, failed, or was skipped. This is useful for monitoring the reliability and results of recurring deployments, drift detection runs, or TTL schedule executions.';
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
  'schedule_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `scheduleID` from the official Pulumi Cloud API operation. The schedule identifier',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/api/stacks/{orgName}/{projectName}/{stackName}/deployments/schedules/{scheduleID}/history';
    protected const PATH_PARAMS = array (
  'orgName' => 'org_name',
  'projectName' => 'project_name',
  'stackName' => 'stack_name',
  'scheduleID' => 'schedule_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
