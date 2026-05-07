<?php

namespace OpenCompany\Integrations\GoogleAppsScript\Tools;

/**
 * Projects Get.
 *
 * Maps to the official Apps Script endpoint GET /v1/projects/{scriptId}.
 */
class GoogleAppsScriptProjectsGet extends AbstractGoogleAppsScriptTool
{
    protected const NAME = 'google_apps_script_projects_get';
    protected const DESCRIPTION = 'Projects Get

Official Apps Script endpoint: GET /v1/projects/{scriptId}
Gets a script project\'s metadata.';
    protected const PARAMETERS = array (
  'scriptId' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `scriptId`. Use official Apps Script identifiers such as script IDs, deployment IDs, or version numbers.',
  ),
);
    protected const METHOD = 'GET';
    protected const PATH = '/v1/projects/{scriptId}';
    protected const PATH_PARAMS = array (
  0 => 'scriptId',
);
    protected const RESERVED_PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = false;
}
