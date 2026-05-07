<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Delete Datasets.
 *
 * Maps to the official LangSmith endpoint DELETE /api/v1/datasets.
 */
class LangSmithDeleteDatasets extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_delete_datasets';
    protected const DESCRIPTION = 'Delete Datasets

Official endpoint: DELETE /api/v1/datasets
Delete multiple datasets.';
    protected const PARAMETERS = array (
  'query' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Query string parameters. Known keys: dataset_ids.',
  ),
  'dataset_ids' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `dataset_ids`.',
  ),
);
    protected const METHOD = 'DELETE';
    protected const PATH = '/api/v1/datasets';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
  0 => 'dataset_ids',
);
    protected const BODY_REQUIRED = false;
    protected const MULTIPART = false;
}
