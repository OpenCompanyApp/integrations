<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * UpdateStackConfig.
 *
 * Maps to the official Pulumi Cloud endpoint put /api/stacks/{orgName}/{projectName}/{stackName}/config.
 */
class PulumiStacksUpdateStackConfig extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_stacks_update_stack_config';
    protected const DESCRIPTION = 'UpdateStackConfig

Official Pulumi Cloud endpoint: PUT /api/stacks/{orgName}/{projectName}/{stackName}/config

Updates the service-managed configuration for a stack. The request body may include the ESC environment reference, secrets provider type, encrypted key, and encryption salt. If stack configuration is returned by the API, it is used in place of the local stack config file (e.g. Pulumi.[stack].yaml). Returns the updated configuration object. Returns 400 if the environment reference is invalid or not found.';
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
    protected const METHOD = 'put';
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
