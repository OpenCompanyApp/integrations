<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * ListStackWebhooks.
 *
 * Maps to the official Pulumi Cloud endpoint get /api/stacks/{orgName}/{projectName}/{stackName}/hooks.
 */
class PulumiStacksListStackWebhooks extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_stacks_list_stack_webhooks';
    protected const DESCRIPTION = 'ListStackWebhooks

Official Pulumi Cloud endpoint: GET /api/stacks/{orgName}/{projectName}/{stackName}/hooks

Returns all webhooks configured for the specified stack. Each webhook in the response includes its name, display name, payload URL, format, filters, and active status.';
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
);
    protected const METHOD = 'get';
    protected const PATH = '/api/stacks/{orgName}/{projectName}/{stackName}/hooks';
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
