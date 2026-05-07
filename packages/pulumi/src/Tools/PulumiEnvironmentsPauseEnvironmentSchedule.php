<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * PauseEnvironmentSchedule.
 *
 * Maps to the official Pulumi Cloud endpoint post /api/esc/environments/{orgName}/{projectName}/{envName}/schedules/{scheduleID}/pause.
 */
class PulumiEnvironmentsPauseEnvironmentSchedule extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_environments_pause_environment_schedule';
    protected const DESCRIPTION = 'PauseEnvironmentSchedule

Official Pulumi Cloud endpoint: POST /api/esc/environments/{orgName}/{projectName}/{envName}/schedules/{scheduleID}/pause

Pauses a scheduled action on a Pulumi ESC environment, preventing any future executions until the schedule is resumed. The schedule\'s configuration is preserved and can be reactivated via the ResumeEnvironmentSchedule endpoint. This is useful for temporarily disabling automated operations like secret rotation without deleting the schedule.';
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
    protected const METHOD = 'post';
    protected const PATH = '/api/esc/environments/{orgName}/{projectName}/{envName}/schedules/{scheduleID}/pause';
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
