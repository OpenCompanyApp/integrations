<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Get Tag.
 *
 * Maps to the official LangSmith endpoint GET /api/v1/repos/{owner}/{repo}/tags/{tag_name}.
 */
class LangSmithGetTag extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_get_tag';
    protected const DESCRIPTION = 'Get Tag

Official endpoint: GET /api/v1/repos/{owner}/{repo}/tags/{tag_name}
Get Tag.';
    protected const PARAMETERS = array (
  'repo' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `repo`.',
  ),
  'tag_name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `tag_name`.',
  ),
);
    protected const METHOD = 'GET';
    protected const PATH = '/api/v1/repos/{owner}/{repo}/tags/{tag_name}';
    protected const PATH_PARAMS = array (
  0 => 'repo',
  1 => 'tag_name',
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = false;
    protected const MULTIPART = false;
}
