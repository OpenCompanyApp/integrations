<?php

namespace OpenCompany\Integrations\GoogleAppsScript\Tools;

/**
 * Projects Deployments List.
 *
 * Maps to the official Apps Script endpoint GET /v1/projects/{scriptId}/deployments.
 */
class GoogleAppsScriptProjectsDeploymentsList extends AbstractGoogleAppsScriptTool
{
    protected const NAME = 'google_apps_script_projects_deployments_list';
    protected const DESCRIPTION = 'Projects Deployments List

Official Apps Script endpoint: GET /v1/projects/{scriptId}/deployments
Lists the deployments of an Apps Script project.';
    protected const PARAMETERS = array (
  'scriptId' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `scriptId`. Use official Apps Script identifiers such as script IDs, deployment IDs, or version numbers.',
  ),
  'query' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Query string parameters accepted by the official Apps Script method. Known keys: pageToken, pageSize.',
  ),
  'pageToken' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `pageToken`.',
  ),
  'pageSize' =>
  array (
    'type' => 'integer',
    'required' => false,
    'description' => 'Shortcut for query parameter `pageSize`.',
  ),
);
    protected const METHOD = 'GET';
    protected const PATH = '/v1/projects/{scriptId}/deployments';
    protected const PATH_PARAMS = array (
  0 => 'scriptId',
);
    protected const RESERVED_PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
  0 => 'pageToken',
  1 => 'pageSize',
);
    protected const BODY_REQUIRED = false;
}
