<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * ListEnvironmentScheduleHistory.
 *
 * Maps to the official Pulumi Cloud endpoint get /api/esc/environments/{orgName}/{projectName}/{envName}/schedules/{scheduleID}/history.
 */
class PulumiEnvironmentsListEnvironmentScheduleHistory extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_environments_list_environment_schedule_history';
    protected const DESCRIPTION = 'ListEnvironmentScheduleHistory

Official Pulumi Cloud endpoint: GET /api/esc/environments/{orgName}/{projectName}/{envName}/schedules/{scheduleID}/history

Returns the execution history for a specific scheduled action on a Pulumi ESC environment. Each history entry includes the execution timestamp, outcome (success or failure), and any error details. This is useful for monitoring the reliability of automated operations like secret rotation.';
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
    protected const METHOD = 'get';
    protected const PATH = '/api/esc/environments/{orgName}/{projectName}/{envName}/schedules/{scheduleID}/history';
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
