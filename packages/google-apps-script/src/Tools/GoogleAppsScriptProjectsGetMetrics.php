<?php

namespace OpenCompany\Integrations\GoogleAppsScript\Tools;

/**
 * Projects Get Metrics.
 *
 * Maps to the official Apps Script endpoint GET /v1/projects/{scriptId}/metrics.
 */
class GoogleAppsScriptProjectsGetMetrics extends AbstractGoogleAppsScriptTool
{
    protected const NAME = 'google_apps_script_projects_get_metrics';
    protected const DESCRIPTION = 'Projects Get Metrics

Official Apps Script endpoint: GET /v1/projects/{scriptId}/metrics
Get metrics data for scripts, such as number of executions and active users.';
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
    'description' => 'Query string parameters accepted by the official Apps Script method. Known keys: metricsGranularity, metricsFilter.deploymentId.',
  ),
  'metricsGranularity' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `metricsGranularity`.',
    'enum' =>
    array (
      0 => 'UNSPECIFIED_GRANULARITY',
      1 => 'WEEKLY',
      2 => 'DAILY',
    ),
  ),
  'metricsFilter.deploymentId' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `metricsFilter.deploymentId`.',
  ),
);
    protected const METHOD = 'GET';
    protected const PATH = '/v1/projects/{scriptId}/metrics';
    protected const PATH_PARAMS = array (
  0 => 'scriptId',
);
    protected const RESERVED_PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
  0 => 'metricsGranularity',
  1 => 'metricsFilter.deploymentId',
);
    protected const BODY_REQUIRED = false;
}
