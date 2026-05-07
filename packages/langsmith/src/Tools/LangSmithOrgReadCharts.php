<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Org Read Charts.
 *
 * Maps to the official LangSmith endpoint POST /api/v1/org-charts.
 */
class LangSmithOrgReadCharts extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_org_read_charts';
    protected const DESCRIPTION = 'Org Read Charts

Official endpoint: POST /api/v1/org-charts
Get all charts for the tenant.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official LangSmith schema.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/api/v1/org-charts';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = true;
    protected const MULTIPART = false;
}
