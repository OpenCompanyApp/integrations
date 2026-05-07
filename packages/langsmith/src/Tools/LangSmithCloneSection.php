<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Clone Section.
 *
 * Maps to the official LangSmith endpoint POST /api/v1/charts/section/clone.
 */
class LangSmithCloneSection extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_clone_section';
    protected const DESCRIPTION = 'Clone Section

Official endpoint: POST /api/v1/charts/section/clone
Clone a dashboard.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official LangSmith schema.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/api/v1/charts/section/clone';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = true;
    protected const MULTIPART = false;
}
