<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Org Read Single Section.
 *
 * Maps to the official LangSmith endpoint POST /api/v1/org-charts/section/{section_id}.
 */
class LangSmithOrgReadSingleSection extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_org_read_single_section';
    protected const DESCRIPTION = 'Org Read Single Section

Official endpoint: POST /api/v1/org-charts/section/{section_id}
Get a single section by ID.';
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
    protected const METHOD = 'POST';
    protected const PATH = '/api/v1/org-charts/section/{section_id}';
    protected const PATH_PARAMS = array (
  0 => 'section_id',
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = true;
    protected const MULTIPART = false;
}
