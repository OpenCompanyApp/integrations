<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Org Create Section.
 *
 * Maps to the official LangSmith endpoint POST /api/v1/org-charts/section.
 */
class LangSmithOrgCreateSection extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_org_create_section';
    protected const DESCRIPTION = 'Org Create Section

Official endpoint: POST /api/v1/org-charts/section
Create a new section.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official LangSmith schema.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/api/v1/org-charts/section';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = true;
    protected const MULTIPART = false;
}
