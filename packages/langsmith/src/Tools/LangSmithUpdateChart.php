<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Update Chart.
 *
 * Maps to the official LangSmith endpoint PATCH /api/v1/charts/{chart_id}.
 */
class LangSmithUpdateChart extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_update_chart';
    protected const DESCRIPTION = 'Update Chart

Official endpoint: PATCH /api/v1/charts/{chart_id}
Update a chart.';
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
    protected const METHOD = 'PATCH';
    protected const PATH = '/api/v1/charts/{chart_id}';
    protected const PATH_PARAMS = array (
  0 => 'chart_id',
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = true;
    protected const MULTIPART = false;
}
