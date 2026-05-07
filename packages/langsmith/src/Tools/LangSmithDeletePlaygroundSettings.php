<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Delete Playground Settings.
 *
 * Maps to the official LangSmith endpoint DELETE /api/v1/playground-settings/{playground_settings_id}.
 */
class LangSmithDeletePlaygroundSettings extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_delete_playground_settings';
    protected const DESCRIPTION = 'Delete Playground Settings

Official endpoint: DELETE /api/v1/playground-settings/{playground_settings_id}
Delete playground settings.';
    protected const PARAMETERS = array (
  'playground_settings_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `playground_settings_id`.',
  ),
);
    protected const METHOD = 'DELETE';
    protected const PATH = '/api/v1/playground-settings/{playground_settings_id}';
    protected const PATH_PARAMS = array (
  0 => 'playground_settings_id',
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = false;
    protected const MULTIPART = false;
}
