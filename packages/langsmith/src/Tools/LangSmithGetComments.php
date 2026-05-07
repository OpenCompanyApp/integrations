<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Get Comments.
 *
 * Maps to the official LangSmith endpoint GET /api/v1/comments/{owner}/{repo}.
 */
class LangSmithGetComments extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_get_comments';
    protected const DESCRIPTION = 'Get Comments

Official endpoint: GET /api/v1/comments/{owner}/{repo}
Get Comments.';
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
  'query' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Query string parameters. Known keys: limit, offset.',
  ),
  'limit' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `limit`.',
  ),
  'offset' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `offset`.',
  ),
);
    protected const METHOD = 'GET';
    protected const PATH = '/api/v1/comments/{owner}/{repo}';
    protected const PATH_PARAMS = array (
  0 => 'owner',
  1 => 'repo',
);
    protected const QUERY_KEYS = array (
  0 => 'limit',
  1 => 'offset',
);
    protected const BODY_REQUIRED = false;
    protected const MULTIPART = false;
}
