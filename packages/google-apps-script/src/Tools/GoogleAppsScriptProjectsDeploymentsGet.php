<?php

namespace OpenCompany\Integrations\GoogleAppsScript\Tools;

/**
 * Projects Deployments Get.
 *
 * Maps to the official Apps Script endpoint GET /v1/projects/{scriptId}/deployments/{deploymentId}.
 */
class GoogleAppsScriptProjectsDeploymentsGet extends AbstractGoogleAppsScriptTool
{
    protected const NAME = 'google_apps_script_projects_deployments_get';
    protected const DESCRIPTION = 'Projects Deployments Get

Official Apps Script endpoint: GET /v1/projects/{scriptId}/deployments/{deploymentId}
Gets a deployment of an Apps Script project.';
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
);
    protected const METHOD = 'GET';
    protected const PATH = '/v1/projects/{scriptId}/deployments/{deploymentId}';
    protected const PATH_PARAMS = array (
  0 => 'scriptId',
  1 => 'deploymentId',
);
    protected const RESERVED_PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = false;
}
