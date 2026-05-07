<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * UpdateEnvironmentSchedule.
 *
 * Maps to the official Pulumi Cloud endpoint patch /api/esc/environments/{orgName}/{projectName}/{envName}/schedules/{scheduleID}.
 */
class PulumiEnvironmentsUpdateEnvironmentSchedule extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_environments_update_environment_schedule';
    protected const DESCRIPTION = 'UpdateEnvironmentSchedule

Official Pulumi Cloud endpoint: PATCH /api/esc/environments/{orgName}/{projectName}/{envName}/schedules/{scheduleID}

Updates the configuration of a scheduled action for a Pulumi ESC environment. The schedule is identified by the scheduleID path parameter. The request body specifies the updated timing and action configuration. Changes take effect for future executions only; any currently running execution is not affected. Returns the updated ScheduledAction on success.';
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
  'body' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'JSON request body matching the official Pulumi Cloud API request schema.',
  ),
);
    protected const METHOD = 'patch';
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
