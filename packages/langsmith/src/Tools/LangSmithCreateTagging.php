<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Create Tagging.
 *
 * Maps to the official LangSmith endpoint POST /api/v1/workspaces/current/taggings.
 */
class LangSmithCreateTagging extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_create_tagging';
    protected const DESCRIPTION = 'Create Tagging

Official endpoint: POST /api/v1/workspaces/current/taggings
Create Tagging.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official LangSmith schema.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/api/v1/workspaces/current/taggings';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = true;
    protected const MULTIPART = false;
}
