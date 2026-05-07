<?php

namespace OpenCompany\Integrations\GoogleAppsScript\Tools;

/**
 * Projects Versions Create.
 *
 * Maps to the official Apps Script endpoint POST /v1/projects/{scriptId}/versions.
 */
class GoogleAppsScriptProjectsVersionsCreate extends AbstractGoogleAppsScriptTool
{
    protected const NAME = 'google_apps_script_projects_versions_create';
    protected const DESCRIPTION = 'Projects Versions Create

Official Apps Script endpoint: POST /v1/projects/{scriptId}/versions
Creates a new immutable version using the current code, with a unique version number.';
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
    'description' => 'JSON request body matching the official Apps Script `Version` schema.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/v1/projects/{scriptId}/versions';
    protected const PATH_PARAMS = array (
  0 => 'scriptId',
);
    protected const RESERVED_PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = true;
}
