<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Read Single Chart.
 *
 * Maps to the official LangSmith endpoint POST /api/v1/charts/{chart_id}.
 */
class LangSmithReadSingleChart extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_read_single_chart';
    protected const DESCRIPTION = 'Read Single Chart

Official endpoint: POST /api/v1/charts/{chart_id}
Get a single chart by ID.';
    protected const PARAMETERS = array (
  'chart_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `chart_id`.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official LangSmith schema.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/api/v1/charts/{chart_id}';
    protected const PATH_PARAMS = array (
  0 => 'chart_id',
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = true;
    protected const MULTIPART = false;
}
