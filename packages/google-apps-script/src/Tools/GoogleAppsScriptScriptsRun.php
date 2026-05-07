<?php

namespace OpenCompany\Integrations\GoogleAppsScript\Tools;

/**
 * Scripts Run.
 *
 * Maps to the official Apps Script endpoint POST /v1/scripts/{scriptId}:run.
 */
class GoogleAppsScriptScriptsRun extends AbstractGoogleAppsScriptTool
{
    protected const NAME = 'google_apps_script_scripts_run';
    protected const DESCRIPTION = 'Scripts Run

Official Apps Script endpoint: POST /v1/scripts/{scriptId}:run
Executes the official Apps Script method.';
    protected const PARAMETERS = array (
  'scriptId' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `scriptId`. Use official Apps Script identifiers such as script IDs, deployment IDs, or version numbers.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Apps Script `ExecutionRequest` schema.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/v1/scripts/{scriptId}:run';
    protected const PATH_PARAMS = array (
  0 => 'scriptId',
);
    protected const RESERVED_PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = true;
}
