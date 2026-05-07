<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Create Playground Settings.
 *
 * Maps to the official LangSmith endpoint POST /api/v1/playground-settings.
 */
class LangSmithCreatePlaygroundSettings extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_create_playground_settings';
    protected const DESCRIPTION = 'Create Playground Settings

Official endpoint: POST /api/v1/playground-settings
Create playground settings.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official LangSmith schema.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/api/v1/playground-settings';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = true;
    protected const MULTIPART = false;
}
