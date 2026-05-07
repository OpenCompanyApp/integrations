<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * List Tags For Resources.
 *
 * Maps to the official LangSmith endpoint POST /api/v1/workspaces/current/tags/resources.
 */
class LangSmithListTagsForResources extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_list_tags_for_resources';
    protected const DESCRIPTION = 'List Tags For Resources

Official endpoint: POST /api/v1/workspaces/current/tags/resources
List Tags For Resources.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official LangSmith schema.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/api/v1/workspaces/current/tags/resources';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = true;
    protected const MULTIPART = false;
}
