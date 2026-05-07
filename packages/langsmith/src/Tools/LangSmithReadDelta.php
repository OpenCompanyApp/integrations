<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Read Delta.
 *
 * Maps to the official LangSmith endpoint POST /api/v1/datasets/{dataset_id}/runs/delta.
 */
class LangSmithReadDelta extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_read_delta';
    protected const DESCRIPTION = 'Read Delta

Official endpoint: POST /api/v1/datasets/{dataset_id}/runs/delta
Fetch the number of regressions/improvements for each example in a dataset, between sessions[0] and sessions[1].';
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
    protected const PATH = '/api/v1/datasets/{dataset_id}/runs/delta';
    protected const PATH_PARAMS = array (
  0 => 'dataset_id',
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = true;
    protected const MULTIPART = false;
}
