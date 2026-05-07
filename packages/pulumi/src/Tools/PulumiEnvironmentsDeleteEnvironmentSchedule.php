<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * DeleteEnvironmentSchedule.
 *
 * Maps to the official Pulumi Cloud endpoint delete /api/esc/environments/{orgName}/{projectName}/{envName}/schedules/{scheduleID}.
 */
class PulumiEnvironmentsDeleteEnvironmentSchedule extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_environments_delete_environment_schedule';
    protected const DESCRIPTION = 'DeleteEnvironmentSchedule

Official Pulumi Cloud endpoint: DELETE /api/esc/environments/{orgName}/{projectName}/{envName}/schedules/{scheduleID}

Permanently deletes a scheduled action from a Pulumi ESC environment. This removes the schedule and cancels any future executions. The schedule is identified by its scheduleID. Requires the secret rotation feature to be enabled for the organization.';
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
  'env_name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `envName` from the official Pulumi Cloud API operation. The environment name',
  ),
  'schedule_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `scheduleID` from the official Pulumi Cloud API operation. The schedule ID',
  ),
);
    protected const METHOD = 'delete';
    protected const PATH = '/api/esc/environments/{orgName}/{projectName}/{envName}/schedules/{scheduleID}';
    protected const PATH_PARAMS = array (
  'orgName' => 'org_name',
  'projectName' => 'project_name',
  'envName' => 'env_name',
  'scheduleID' => 'schedule_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
