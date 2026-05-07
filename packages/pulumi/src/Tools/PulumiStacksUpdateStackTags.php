<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * UpdateStackTags.
 *
 * Maps to the official Pulumi Cloud endpoint patch /api/stacks/{orgName}/{projectName}/{stackName}/tags.
 */
class PulumiStacksUpdateStackTags extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_stacks_update_stack_tags';
    protected const DESCRIPTION = 'UpdateStackTags

Official Pulumi Cloud endpoint: PATCH /api/stacks/{orgName}/{projectName}/{stackName}/tags

Replaces all tags on the specified stack with the tags provided in the request body. This is a wholesale replacement operation: any existing tags not included in the request will be removed. The request body is a JSON map of tag name-value pairs. Returns 400 if the operation would change the project name tag or if any tags are invalid.';
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
