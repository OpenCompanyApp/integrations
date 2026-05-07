<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Generate.
 *
 * Maps to the official LangSmith endpoint POST /api/v1/datasets/{dataset_id}/generate.
 */
class LangSmithGenerate extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_generate';
    protected const DESCRIPTION = 'Generate

Official endpoint: POST /api/v1/datasets/{dataset_id}/generate
Generate synthetic examples for a dataset.';
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
    protected const PATH = '/api/v1/datasets/{dataset_id}/generate';
    protected const PATH_PARAMS = array (
  0 => 'dataset_id',
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = true;
    protected const MULTIPART = false;
}
