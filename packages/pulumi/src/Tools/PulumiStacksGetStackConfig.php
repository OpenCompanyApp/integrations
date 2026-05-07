<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * GetStackConfig.
 *
 * Maps to the official Pulumi Cloud endpoint get /api/stacks/{orgName}/{projectName}/{stackName}/config.
 */
class PulumiStacksGetStackConfig extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_stacks_get_stack_config';
    protected const DESCRIPTION = 'GetStackConfig

Official Pulumi Cloud endpoint: GET /api/stacks/{orgName}/{projectName}/{stackName}/config

Retrieves the service-managed configuration for a stack. The response includes the ESC environment reference, secrets provider type, encrypted key, and encryption salt. If stack configuration is returned by the API, it is used in place of the local stack config file (e.g. Pulumi.[stack].yaml). Returns 404 if no service-managed configuration exists for the stack.';
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
    protected const PATH = '/api/stacks/{orgName}/{projectName}/{stackName}/config';
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
