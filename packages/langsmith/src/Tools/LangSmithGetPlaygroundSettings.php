<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Get Playground Settings.
 *
 * Maps to the official LangSmith endpoint GET /api/v1/playground-settings/{playground_settings_id}.
 */
class LangSmithGetPlaygroundSettings extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_get_playground_settings';
    protected const DESCRIPTION = 'Get Playground Settings

Official endpoint: GET /api/v1/playground-settings/{playground_settings_id}
Get a single playground settings by ID.';
    protected const PARAMETERS = array (
  'playground_settings_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `playground_settings_id`.',
  ),
);
    protected const METHOD = 'GET';
    protected const PATH = '/api/v1/playground-settings/{playground_settings_id}';
    protected const PATH_PARAMS = array (
  0 => 'playground_settings_id',
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = false;
    protected const MULTIPART = false;
}
