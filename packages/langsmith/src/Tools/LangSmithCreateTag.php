<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Create Tag.
 *
 * Maps to the official LangSmith endpoint POST /api/v1/repos/{owner}/{repo}/tags.
 */
class LangSmithCreateTag extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_create_tag';
    protected const DESCRIPTION = 'Create Tag

Official endpoint: POST /api/v1/repos/{owner}/{repo}/tags
Create a tag. Requires repo ownership, prompts:tag permission, or ABAC grant.';
    protected const PARAMETERS = array (
  'owner' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `owner`.',
  ),
  'repo' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `repo`.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official LangSmith schema.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/api/v1/repos/{owner}/{repo}/tags';
    protected const PATH_PARAMS = array (
  0 => 'owner',
  1 => 'repo',
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = true;
    protected const MULTIPART = false;
}
