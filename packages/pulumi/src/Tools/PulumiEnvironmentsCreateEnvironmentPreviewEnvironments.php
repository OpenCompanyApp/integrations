<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * CreateEnvironment.
 *
 * Maps to the official Pulumi Cloud endpoint post /api/preview/environments/{orgName}/{envName}.
 */
class PulumiEnvironmentsCreateEnvironmentPreviewEnvironments extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_environments_create_environment_preview_environments';
    protected const DESCRIPTION = 'CreateEnvironment

Official Pulumi Cloud endpoint: POST /api/preview/environments/{orgName}/{envName}

Creates a new Pulumi ESC (Environments, Secrets, and Configuration) environment within the specified organization. The request body must include the project name and the environment name. Environment names must be unique within a project and may only contain alphanumeric characters, hyphens, underscores, and periods. The newly created environment starts with an empty YAML definition that can be updated via the UpdateEnvironment endpoint.';
    protected const PARAMETERS = array (
  'org_name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `orgName` from the official Pulumi Cloud API operation. The organization name',
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
    protected const PATH = '/api/preview/environments/{orgName}/{envName}';
    protected const PATH_PARAMS = array (
  'orgName' => 'org_name',
  'envName' => 'env_name',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
