<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Org Delete Section.
 *
 * Maps to the official LangSmith endpoint DELETE /api/v1/org-charts/section/{section_id}.
 */
class LangSmithOrgDeleteSection extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_org_delete_section';
    protected const DESCRIPTION = 'Org Delete Section

Official endpoint: DELETE /api/v1/org-charts/section/{section_id}
Delete a section.';
    protected const PARAMETERS = array (
  'section_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `section_id`.',
  ),
);
    protected const METHOD = 'DELETE';
    protected const PATH = '/api/v1/org-charts/section/{section_id}';
    protected const PATH_PARAMS = array (
  0 => 'section_id',
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = false;
    protected const MULTIPART = false;
}
