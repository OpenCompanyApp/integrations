<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Delete Tag.
 *
 * Maps to the official LangSmith endpoint DELETE /api/v1/repos/{owner}/{repo}/tags/{tag_name}.
 */
class LangSmithDeleteTag extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_delete_tag';
    protected const DESCRIPTION = 'Delete Tag

Official endpoint: DELETE /api/v1/repos/{owner}/{repo}/tags/{tag_name}
Delete a tag. Requires repo ownership, prompts:tag permission, or ABAC grant.';
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
);
    protected const METHOD = 'DELETE';
    protected const PATH = '/api/v1/repos/{owner}/{repo}/tags/{tag_name}';
    protected const PATH_PARAMS = array (
  0 => 'owner',
  1 => 'repo',
  2 => 'tag_name',
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = false;
    protected const MULTIPART = false;
}
