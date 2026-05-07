<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Update Tag.
 *
 * Maps to the official LangSmith endpoint PATCH /api/v1/repos/{owner}/{repo}/tags/{tag_name}.
 */
class LangSmithUpdateTag extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_update_tag';
    protected const DESCRIPTION = 'Update Tag

Official endpoint: PATCH /api/v1/repos/{owner}/{repo}/tags/{tag_name}
Update a tag. Requires repo ownership, prompts:tag permission, or ABAC grant.';
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
  'tag_name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `tag_name`.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official LangSmith schema.',
  ),
);
    protected const METHOD = 'PATCH';
    protected const PATH = '/api/v1/repos/{owner}/{repo}/tags/{tag_name}';
    protected const PATH_PARAMS = array (
  0 => 'owner',
  1 => 'repo',
  2 => 'tag_name',
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = true;
    protected const MULTIPART = false;
}
