<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Update Dataset.
 *
 * Maps to the official LangSmith endpoint PATCH /api/v1/datasets/{dataset_id}.
 */
class LangSmithUpdateDataset extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_update_dataset';
    protected const DESCRIPTION = 'Update Dataset

Official endpoint: PATCH /api/v1/datasets/{dataset_id}
Update a specific dataset.';
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
    protected const METHOD = 'PATCH';
    protected const PATH = '/api/v1/datasets/{dataset_id}';
    protected const PATH_PARAMS = array (
  0 => 'dataset_id',
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = true;
    protected const MULTIPART = false;
}
