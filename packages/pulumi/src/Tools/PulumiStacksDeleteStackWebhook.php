<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * DeleteStackWebhook.
 *
 * Maps to the official Pulumi Cloud endpoint delete /api/stacks/{orgName}/{projectName}/{stackName}/hooks/{hookName}.
 */
class PulumiStacksDeleteStackWebhook extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_stacks_delete_stack_webhook';
    protected const DESCRIPTION = 'DeleteStackWebhook

Official Pulumi Cloud endpoint: DELETE /api/stacks/{orgName}/{projectName}/{stackName}/hooks/{hookName}

Deletes a webhook from the specified stack. Returns 204 with no content on success.';
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
  'hook_name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `hookName` from the official Pulumi Cloud API operation. The webhook name',
  ),
);
    protected const METHOD = 'delete';
    protected const PATH = '/api/stacks/{orgName}/{projectName}/{stackName}/hooks/{hookName}';
    protected const PATH_PARAMS = array (
  'orgName' => 'org_name',
  'projectName' => 'project_name',
  'stackName' => 'stack_name',
  'hookName' => 'hook_name',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
