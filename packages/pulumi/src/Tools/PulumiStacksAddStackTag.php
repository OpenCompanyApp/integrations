<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * AddStackTag.
 *
 * Maps to the official Pulumi Cloud endpoint post /api/stacks/{orgName}/{projectName}/{stackName}/tags.
 */
class PulumiStacksAddStackTag extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_stacks_add_stack_tag';
    protected const DESCRIPTION = 'AddStackTag

Official Pulumi Cloud endpoint: POST /api/stacks/{orgName}/{projectName}/{stackName}/tags

Creates a new tag on the specified stack. Tags are key-value metadata pairs that can be used for organization, filtering, and storing additional information about stacks. The request body must include both a tag name and value. Returns 400 if the tag name is invalid or the tag already exists. Built-in tags (such as those automatically set by the Pulumi CLI) follow specific naming conventions.';
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
    protected const METHOD = 'post';
    protected const PATH = '/api/stacks/{orgName}/{projectName}/{stackName}/tags';
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
