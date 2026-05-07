<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Like Comment.
 *
 * Maps to the official LangSmith endpoint POST /api/v1/comments/{owner}/{repo}/{parent_comment_id}/like.
 */
class LangSmithLikeComment extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_like_comment';
    protected const DESCRIPTION = 'Like Comment

Official endpoint: POST /api/v1/comments/{owner}/{repo}/{parent_comment_id}/like
Like Comment.';
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
);
    protected const METHOD = 'POST';
    protected const PATH = '/api/v1/comments/{owner}/{repo}/{parent_comment_id}/like';
    protected const PATH_PARAMS = array (
  0 => 'owner',
  1 => 'repo',
  2 => 'parent_comment_id',
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = false;
    protected const MULTIPART = false;
}
