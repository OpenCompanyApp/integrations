<?php

namespace OpenCompany\Integrations\GoogleAppsScript\Tools;

/**
 * Projects Get Content.
 *
 * Maps to the official Apps Script endpoint GET /v1/projects/{scriptId}/content.
 */
class GoogleAppsScriptProjectsGetContent extends AbstractGoogleAppsScriptTool
{
    protected const NAME = 'google_apps_script_projects_get_content';
    protected const DESCRIPTION = 'Projects Get Content

Official Apps Script endpoint: GET /v1/projects/{scriptId}/content
Gets the content of the script project, including the code source and metadata for each script file.';
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
    'description' => 'Query string parameters accepted by the official Apps Script method. Known keys: versionNumber.',
  ),
  'versionNumber' =>
  array (
    'type' => 'integer',
    'required' => false,
    'description' => 'Shortcut for query parameter `versionNumber`.',
  ),
);
    protected const METHOD = 'GET';
    protected const PATH = '/v1/projects/{scriptId}/content';
    protected const PATH_PARAMS = array (
  0 => 'scriptId',
);
    protected const RESERVED_PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
  0 => 'versionNumber',
);
    protected const BODY_REQUIRED = false;
}
