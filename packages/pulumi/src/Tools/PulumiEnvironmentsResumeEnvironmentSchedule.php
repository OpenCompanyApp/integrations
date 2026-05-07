<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * ResumeEnvironmentSchedule.
 *
 * Maps to the official Pulumi Cloud endpoint post /api/esc/environments/{orgName}/{projectName}/{envName}/schedules/{scheduleID}/resume.
 */
class PulumiEnvironmentsResumeEnvironmentSchedule extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_environments_resume_environment_schedule';
    protected const DESCRIPTION = 'ResumeEnvironmentSchedule

Official Pulumi Cloud endpoint: POST /api/esc/environments/{orgName}/{projectName}/{envName}/schedules/{scheduleID}/resume

Resumes a previously paused scheduled action on a Pulumi ESC environment, re-enabling future executions. The schedule will continue from its next scheduled time according to its configured timing (cron expression or one-time schedule). The schedule is identified by the scheduleID path parameter.';
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
    protected const PATH = '/api/esc/environments/{orgName}/{projectName}/{envName}/schedules/{scheduleID}/resume';
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
