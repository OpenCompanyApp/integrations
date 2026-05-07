<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Create Dataset.
 *
 * Maps to the official LangSmith endpoint POST /api/v1/datasets.
 */
class LangSmithCreateDataset extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_create_dataset';
    protected const DESCRIPTION = 'Create Dataset

Official endpoint: POST /api/v1/datasets
Create a new dataset.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official LangSmith schema.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/api/v1/datasets';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = true;
    protected const MULTIPART = false;
}
