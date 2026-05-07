<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Create Tag Key.
 *
 * Maps to the official LangSmith endpoint POST /api/v1/workspaces/current/tag-keys.
 */
class LangSmithCreateTagKey extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_create_tag_key';
    protected const DESCRIPTION = 'Create Tag Key

Official endpoint: POST /api/v1/workspaces/current/tag-keys
Create Tag Key.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official LangSmith schema.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/api/v1/workspaces/current/tag-keys';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = true;
    protected const MULTIPART = false;
}
