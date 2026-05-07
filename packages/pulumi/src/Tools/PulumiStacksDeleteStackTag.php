<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * DeleteStackTag.
 *
 * Maps to the official Pulumi Cloud endpoint delete /api/stacks/{orgName}/{projectName}/{stackName}/tags/{tagName}.
 */
class PulumiStacksDeleteStackTag extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_stacks_delete_stack_tag';
    protected const DESCRIPTION = 'DeleteStackTag

Official Pulumi Cloud endpoint: DELETE /api/stacks/{orgName}/{projectName}/{stackName}/tags/{tagName}

Removes a specific tag from the stack, identified by the tag name in the URL path. Built-in tags (those automatically managed by the Pulumi CLI) cannot be deleted and will return a 400 error. Returns 404 if the specified tag does not exist on the stack. Returns 204 with no content on success.';
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
  'tag_name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `tagName` from the official Pulumi Cloud API operation. The tag name',
  ),
);
    protected const METHOD = 'delete';
    protected const PATH = '/api/stacks/{orgName}/{projectName}/{stackName}/tags/{tagName}';
    protected const PATH_PARAMS = array (
  'orgName' => 'org_name',
  'projectName' => 'project_name',
  'stackName' => 'stack_name',
  'tagName' => 'tag_name',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
