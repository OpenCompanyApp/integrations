<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Delete Dataset.
 *
 * Maps to the official LangSmith endpoint DELETE /api/v1/datasets/{dataset_id}.
 */
class LangSmithDeleteDataset extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_delete_dataset';
    protected const DESCRIPTION = 'Delete Dataset

Official endpoint: DELETE /api/v1/datasets/{dataset_id}
Delete a specific dataset.';
    protected const PARAMETERS = array (
  'dataset_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `dataset_id`.',
  ),
);
    protected const METHOD = 'DELETE';
    protected const PATH = '/api/v1/datasets/{dataset_id}';
    protected const PATH_PARAMS = array (
  0 => 'dataset_id',
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = false;
    protected const MULTIPART = false;
}
