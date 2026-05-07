<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Read Chart Preview.
 *
 * Maps to the official LangSmith endpoint POST /api/v1/charts/preview.
 */
class LangSmithReadChartPreview extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_read_chart_preview';
    protected const DESCRIPTION = 'Read Chart Preview

Official endpoint: POST /api/v1/charts/preview
Get a preview for a chart without actually creating it.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official LangSmith schema.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/api/v1/charts/preview';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = true;
    protected const MULTIPART = false;
}
