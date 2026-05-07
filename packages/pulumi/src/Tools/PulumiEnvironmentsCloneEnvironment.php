<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * CloneEnvironment.
 *
 * Maps to the official Pulumi Cloud endpoint post /api/esc/environments/{orgName}/{projectName}/{envName}/clone.
 */
class PulumiEnvironmentsCloneEnvironment extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_environments_clone_environment';
    protected const DESCRIPTION = 'CloneEnvironment

Official Pulumi Cloud endpoint: POST /api/esc/environments/{orgName}/{projectName}/{envName}/clone

Creates a duplicate of a Pulumi ESC environment in a new project and/or under a new name. The request body specifies the destination project and environment name, along with options to control what is preserved during the clone: preserveAccess retains permission settings, preserveHistory retains the full revision history, preserveEnvironmentTags retains environment-level tags, and preserveRevisionTags retains version-specific tags. Environments cannot be renamed directly, so cloning is the mechanism for moving or renaming environments.';
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
  'body' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'JSON request body matching the official Pulumi Cloud API request schema.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/api/esc/environments/{orgName}/{projectName}/{envName}/clone';
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
