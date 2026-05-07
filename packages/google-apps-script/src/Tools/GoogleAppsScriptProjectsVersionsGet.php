<?php

namespace OpenCompany\Integrations\GoogleAppsScript\Tools;

/**
 * Projects Versions Get.
 *
 * Maps to the official Apps Script endpoint GET /v1/projects/{scriptId}/versions/{versionNumber}.
 */
class GoogleAppsScriptProjectsVersionsGet extends AbstractGoogleAppsScriptTool
{
    protected const NAME = 'google_apps_script_projects_versions_get';
    protected const DESCRIPTION = 'Projects Versions Get

Official Apps Script endpoint: GET /v1/projects/{scriptId}/versions/{versionNumber}
Gets a version of a script project.';
    protected const PARAMETERS = array (
  'scriptId' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `scriptId`. Use official Apps Script identifiers such as script IDs, deployment IDs, or version numbers.',
  ),
  'versionNumber' =>
  array (
    'type' => 'integer',
    'required' => true,
    'description' => 'Path parameter `versionNumber`. Use official Apps Script identifiers such as script IDs, deployment IDs, or version numbers.',
  ),
);
    protected const METHOD = 'GET';
    protected const PATH = '/v1/projects/{scriptId}/versions/{versionNumber}';
    protected const PATH_PARAMS = array (
  0 => 'scriptId',
  1 => 'versionNumber',
);
    protected const RESERVED_PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = false;
}
