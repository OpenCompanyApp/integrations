<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * ListEnvironmentSecretRotationHistory.
 *
 * Maps to the official Pulumi Cloud endpoint get /api/esc/environments/{orgName}/{projectName}/{envName}/rotate/history.
 */
class PulumiEnvironmentsListEnvironmentSecretRotationHistory extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_environments_list_environment_secret_rotation_history';
    protected const DESCRIPTION = 'ListEnvironmentSecretRotationHistory

Official Pulumi Cloud endpoint: GET /api/esc/environments/{orgName}/{projectName}/{envName}/rotate/history

Returns the secret rotation history for a Pulumi ESC environment. Each entry represents a rotation event where secrets defined with fn::rotate were cycled to new values in their external systems. The response includes timestamps, outcomes, and the rotators involved. Requires the secret rotation feature to be enabled for the organization.';
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
);
    protected const METHOD = 'get';
    protected const PATH = '/api/esc/environments/{orgName}/{projectName}/{envName}/rotate/history';
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
