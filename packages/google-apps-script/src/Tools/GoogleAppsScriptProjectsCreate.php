<?php

namespace OpenCompany\Integrations\GoogleAppsScript\Tools;

/**
 * Projects Create.
 *
 * Maps to the official Apps Script endpoint POST /v1/projects.
 */
class GoogleAppsScriptProjectsCreate extends AbstractGoogleAppsScriptTool
{
    protected const NAME = 'google_apps_script_projects_create';
    protected const DESCRIPTION = 'Projects Create

Official Apps Script endpoint: POST /v1/projects
Creates a new, empty script project with no script files and a base manifest file.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Apps Script `CreateProjectRequest` schema.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/v1/projects';
    protected const PATH_PARAMS = array (
);
    protected const RESERVED_PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = true;
}
