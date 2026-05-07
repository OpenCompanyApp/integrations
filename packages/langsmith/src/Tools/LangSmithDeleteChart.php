<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Delete Chart.
 *
 * Maps to the official LangSmith endpoint DELETE /api/v1/charts/{chart_id}.
 */
class LangSmithDeleteChart extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_delete_chart';
    protected const DESCRIPTION = 'Delete Chart

Official endpoint: DELETE /api/v1/charts/{chart_id}
Delete a chart.';
    protected const PARAMETERS = array (
  'chart_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `chart_id`.',
  ),
);
    protected const METHOD = 'DELETE';
    protected const PATH = '/api/v1/charts/{chart_id}';
    protected const PATH_PARAMS = array (
  0 => 'chart_id',
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = false;
    protected const MULTIPART = false;
}
