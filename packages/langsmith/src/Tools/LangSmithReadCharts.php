<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Read Charts.
 *
 * Maps to the official LangSmith endpoint POST /api/v1/charts.
 */
class LangSmithReadCharts extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_read_charts';
    protected const DESCRIPTION = 'Read Charts

Official endpoint: POST /api/v1/charts
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
    protected const PATH = '/api/v1/charts';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = true;
    protected const MULTIPART = false;
}
