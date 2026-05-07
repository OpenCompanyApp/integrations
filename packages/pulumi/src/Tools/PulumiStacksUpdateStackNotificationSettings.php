<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * UpdateStackNotificationSettings.
 *
 * Maps to the official Pulumi Cloud endpoint patch /api/stacks/{orgName}/{projectName}/{stackName}/notifications/settings.
 */
class PulumiStacksUpdateStackNotificationSettings extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_stacks_update_stack_notification_settings';
    protected const DESCRIPTION = 'UpdateStackNotificationSettings

Official Pulumi Cloud endpoint: PATCH /api/stacks/{orgName}/{projectName}/{stackName}/notifications/settings

Updates the notification settings for a stack, controlling whether notifications are sent on update success or failure. The request body specifies the notification preferences. Returns the updated stack metadata including the new notification settings.';
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
  'body' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'JSON request body matching the official Pulumi Cloud API request schema.',
  ),
);
    protected const METHOD = 'patch';
    protected const PATH = '/api/stacks/{orgName}/{projectName}/{stackName}/notifications/settings';
    protected const PATH_PARAMS = array (
  'orgName' => 'org_name',
  'projectName' => 'project_name',
  'stackName' => 'stack_name',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
