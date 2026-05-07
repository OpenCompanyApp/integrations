<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Org Create Chart.
 *
 * Maps to the official LangSmith endpoint POST /api/v1/org-charts/create.
 */
class LangSmithOrgCreateChart extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_org_create_chart';
    protected const DESCRIPTION = 'Org Create Chart

Official endpoint: POST /api/v1/org-charts/create
Create a new chart.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official LangSmith schema.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/api/v1/org-charts/create';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = true;
    protected const MULTIPART = false;
}
