<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Read Grouped Experiments.
 *
 * Maps to the official LangSmith endpoint POST /api/v1/datasets/{dataset_id}/experiments/grouped.
 */
class LangSmithReadGroupedExperiments extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_read_grouped_experiments';
    protected const DESCRIPTION = 'Read Grouped Experiments

Official endpoint: POST /api/v1/datasets/{dataset_id}/experiments/grouped
Stream grouped and aggregated experiments.';
    protected const PARAMETERS = array (
  'dataset_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `dataset_id`.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official LangSmith schema.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/api/v1/datasets/{dataset_id}/experiments/grouped';
    protected const PATH_PARAMS = array (
  0 => 'dataset_id',
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = true;
    protected const MULTIPART = false;
}
