<?php

namespace OpenCompany\Integrations\GoogleAppsScript\Tools;

/**
 * Projects Update Content.
 *
 * Maps to the official Apps Script endpoint PUT /v1/projects/{scriptId}/content.
 */
class GoogleAppsScriptProjectsUpdateContent extends AbstractGoogleAppsScriptTool
{
    protected const NAME = 'google_apps_script_projects_update_content';
    protected const DESCRIPTION = 'Projects Update Content

Official Apps Script endpoint: PUT /v1/projects/{scriptId}/content
Updates the content of the specified script project.';
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
    'description' => 'JSON request body matching the official Apps Script `Content` schema.',
  ),
);
    protected const METHOD = 'PUT';
    protected const PATH = '/v1/projects/{scriptId}/content';
    protected const PATH_PARAMS = array (
  0 => 'scriptId',
);
    protected const RESERVED_PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = true;
}
