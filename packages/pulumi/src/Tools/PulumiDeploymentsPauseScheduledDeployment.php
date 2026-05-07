<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * PauseScheduledDeployment.
 *
 * Maps to the official Pulumi Cloud endpoint post /api/stacks/{orgName}/{projectName}/{stackName}/deployments/schedules/{scheduleID}/pause.
 */
class PulumiDeploymentsPauseScheduledDeployment extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_deployments_pause_scheduled_deployment';
    protected const DESCRIPTION = 'PauseScheduledDeployment

Official Pulumi Cloud endpoint: POST /api/stacks/{orgName}/{projectName}/{stackName}/deployments/schedules/{scheduleID}/pause

Temporarily suspends future executions of a scheduled deployment action without deleting the schedule configuration. The schedule remains configured and can be reactivated at any time using the ResumeScheduledDeployment endpoint. This is useful for temporarily halting recurring schedules (drift detection, TTL, or custom) during maintenance periods or when troubleshooting issues.';
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
    protected const METHOD = 'post';
    protected const PATH = '/api/stacks/{orgName}/{projectName}/{stackName}/deployments/schedules/{scheduleID}/pause';
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
