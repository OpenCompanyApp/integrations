<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Update Playground Settings.
 *
 * Maps to the official LangSmith endpoint PATCH /api/v1/playground-settings/{playground_settings_id}.
 */
class LangSmithUpdatePlaygroundSettings extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_update_playground_settings';
    protected const DESCRIPTION = 'Update Playground Settings

Official endpoint: PATCH /api/v1/playground-settings/{playground_settings_id}
Update playground settings.';
    protected const PARAMETERS = array (
  'playground_settings_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `playground_settings_id`.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official LangSmith schema.',
  ),
);
    protected const METHOD = 'PATCH';
    protected const PATH = '/api/v1/playground-settings/{playground_settings_id}';
    protected const PATH_PARAMS = array (
  0 => 'playground_settings_id',
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = true;
    protected const MULTIPART = false;
}
