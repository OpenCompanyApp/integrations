<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * CreateEnvironmentSchedule.
 *
 * Maps to the official Pulumi Cloud endpoint post /api/esc/environments/{orgName}/{projectName}/{envName}/schedules.
 */
class PulumiEnvironmentsCreateEnvironmentSchedule extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_environments_create_environment_schedule';
    protected const DESCRIPTION = 'CreateEnvironmentSchedule

Official Pulumi Cloud endpoint: POST /api/esc/environments/{orgName}/{projectName}/{envName}/schedules

Creates a new scheduled action for a Pulumi ESC environment. Schedules can be used to automate recurring operations on environments, such as secret rotation. The request body specifies the schedule timing and the action to perform. Returns the created ScheduledAction on success. Requires the secret rotation feature to be enabled for the organization.';
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
  'body' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'JSON request body matching the official Pulumi Cloud API request schema.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/api/esc/environments/{orgName}/{projectName}/{envName}/schedules';
    protected const PATH_PARAMS = array (
  'orgName' => 'org_name',
  'projectName' => 'project_name',
  'envName' => 'env_name',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
