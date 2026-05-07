<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Create Sub Comment.
 *
 * Maps to the official LangSmith endpoint POST /api/v1/comments/{owner}/{repo}/{parent_comment_id}.
 */
class LangSmithCreateSubComment extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_create_sub_comment';
    protected const DESCRIPTION = 'Create Sub Comment

Official endpoint: POST /api/v1/comments/{owner}/{repo}/{parent_comment_id}
Create Sub Comment.';
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
  'parent_comment_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `parent_comment_id`.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official LangSmith schema.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/api/v1/comments/{owner}/{repo}/{parent_comment_id}';
    protected const PATH_PARAMS = array (
  0 => 'owner',
  1 => 'repo',
  2 => 'parent_comment_id',
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = true;
    protected const MULTIPART = false;
}
