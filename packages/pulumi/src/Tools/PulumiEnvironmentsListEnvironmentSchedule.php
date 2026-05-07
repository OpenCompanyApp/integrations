<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * ListEnvironmentSchedule.
 *
 * Maps to the official Pulumi Cloud endpoint get /api/esc/environments/{orgName}/{projectName}/{envName}/schedules.
 */
class PulumiEnvironmentsListEnvironmentSchedule extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_environments_list_environment_schedule';
    protected const DESCRIPTION = 'ListEnvironmentSchedule

Official Pulumi Cloud endpoint: GET /api/esc/environments/{orgName}/{projectName}/{envName}/schedules

Returns all scheduled actions configured for a Pulumi ESC environment. Schedules automate recurring operations such as secret rotation. The response includes each schedule\'s timing configuration, action type, and current status (active or paused).';
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
);
    protected const METHOD = 'get';
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
