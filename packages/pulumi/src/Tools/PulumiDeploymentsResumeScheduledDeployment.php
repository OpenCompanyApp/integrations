<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * ResumeScheduledDeployment.
 *
 * Maps to the official Pulumi Cloud endpoint post /api/stacks/{orgName}/{projectName}/{stackName}/deployments/schedules/{scheduleID}/resume.
 */
class PulumiDeploymentsResumeScheduledDeployment extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_deployments_resume_scheduled_deployment';
    protected const DESCRIPTION = 'ResumeScheduledDeployment

Official Pulumi Cloud endpoint: POST /api/stacks/{orgName}/{projectName}/{stackName}/deployments/schedules/{scheduleID}/resume

Reactivates a previously paused scheduled deployment action. After resuming, the schedule will continue executing according to its configured timing (cron expression for recurring schedules, or at the scheduled timestamp for one-time schedules). This works for all schedule types: custom deployment schedules, drift detection schedules, and TTL schedules.';
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
    protected const PATH = '/api/stacks/{orgName}/{projectName}/{stackName}/deployments/schedules/{scheduleID}/resume';
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
