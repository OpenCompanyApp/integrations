<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Get Tags.
 *
 * Maps to the official LangSmith endpoint GET /api/v1/repos/{owner}/{repo}/tags.
 */
class LangSmithGetTags extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_get_tags';
    protected const DESCRIPTION = 'Get Tags

Official endpoint: GET /api/v1/repos/{owner}/{repo}/tags
Get Tags.';
    protected const PARAMETERS = array (
  'repo' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `repo`.',
  ),
);
    protected const METHOD = 'GET';
    protected const PATH = '/api/v1/repos/{owner}/{repo}/tags';
    protected const PATH_PARAMS = array (
  0 => 'repo',
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = false;
    protected const MULTIPART = false;
}
