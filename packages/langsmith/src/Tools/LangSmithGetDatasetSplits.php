<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Get Dataset Splits.
 *
 * Maps to the official LangSmith endpoint GET /api/v1/datasets/{dataset_id}/splits.
 */
class LangSmithGetDatasetSplits extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_get_dataset_splits';
    protected const DESCRIPTION = 'Get Dataset Splits

Official endpoint: GET /api/v1/datasets/{dataset_id}/splits
Get Dataset Splits.';
    protected const PARAMETERS = array (
  'dataset_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `dataset_id`.',
  ),
  'query' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Query string parameters. Known keys: as_of.',
  ),
  'as_of' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `as_of`.',
  ),
);
    protected const METHOD = 'GET';
    protected const PATH = '/api/v1/datasets/{dataset_id}/splits';
    protected const PATH_PARAMS = array (
  0 => 'dataset_id',
);
    protected const QUERY_KEYS = array (
  0 => 'as_of',
);
    protected const BODY_REQUIRED = false;
    protected const MULTIPART = false;
}
