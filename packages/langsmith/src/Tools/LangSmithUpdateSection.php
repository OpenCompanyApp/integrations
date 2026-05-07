<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Update Section.
 *
 * Maps to the official LangSmith endpoint PATCH /api/v1/charts/section/{section_id}.
 */
class LangSmithUpdateSection extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_update_section';
    protected const DESCRIPTION = 'Update Section

Official endpoint: PATCH /api/v1/charts/section/{section_id}
Update a section.';
    protected const PARAMETERS = array (
  'section_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `section_id`.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official LangSmith schema.',
  ),
);
    protected const METHOD = 'PATCH';
    protected const PATH = '/api/v1/charts/section/{section_id}';
    protected const PATH_PARAMS = array (
  0 => 'section_id',
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = true;
    protected const MULTIPART = false;
}
