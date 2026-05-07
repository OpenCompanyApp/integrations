<?php

namespace OpenCompany\Integrations\GoogleAppsScript\Tools;

/**
 * Projects Deployments Update.
 *
 * Maps to the official Apps Script endpoint PUT /v1/projects/{scriptId}/deployments/{deploymentId}.
 */
class GoogleAppsScriptProjectsDeploymentsUpdate extends AbstractGoogleAppsScriptTool
{
    protected const NAME = 'google_apps_script_projects_deployments_update';
    protected const DESCRIPTION = 'Projects Deployments Update

Official Apps Script endpoint: PUT /v1/projects/{scriptId}/deployments/{deploymentId}
Updates a deployment of an Apps Script project.';
    protected const PARAMETERS = array (
  'scriptId' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `scriptId`. Use official Apps Script identifiers such as script IDs, deployment IDs, or version numbers.',
  ),
  'deploymentId' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `deploymentId`. Use official Apps Script identifiers such as script IDs, deployment IDs, or version numbers.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Apps Script `UpdateDeploymentRequest` schema.',
  ),
);
    protected const METHOD = 'PUT';
    protected const PATH = '/v1/projects/{scriptId}/deployments/{deploymentId}';
    protected const PATH_PARAMS = array (
  0 => 'scriptId',
  1 => 'deploymentId',
);
    protected const RESERVED_PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = true;
}
