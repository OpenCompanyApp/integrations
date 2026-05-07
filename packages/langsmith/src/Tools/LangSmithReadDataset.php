<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Read Dataset.
 *
 * Maps to the official LangSmith endpoint GET /api/v1/datasets/{dataset_id}.
 */
class LangSmithReadDataset extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_read_dataset';
    protected const DESCRIPTION = 'Read Dataset

Official endpoint: GET /api/v1/datasets/{dataset_id}
Get a specific dataset.';
    protected const PARAMETERS = array (
  'dataset_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `dataset_id`.',
  ),
);
    protected const METHOD = 'GET';
    protected const PATH = '/api/v1/datasets/{dataset_id}';
    protected const PATH_PARAMS = array (
  0 => 'dataset_id',
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = false;
    protected const MULTIPART = false;
}
