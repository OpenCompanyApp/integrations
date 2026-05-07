<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Upload Examples From Csv.
 *
 * Maps to the official LangSmith endpoint POST /api/v1/examples/upload/{dataset_id}.
 */
class LangSmithUploadExamplesFromCsv extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_upload_examples_from_csv';
    protected const DESCRIPTION = 'Upload Examples From Csv

Official endpoint: POST /api/v1/examples/upload/{dataset_id}
Upload examples from a CSV file. Note: For non-csv upload, please use the POST /v1/platform/datasets/{dataset_id}/examples endpoint which provides more efficient upload.';
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
    'description' => 'Multipart form fields. Use file_path for a local upload file when required.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/api/v1/examples/upload/{dataset_id}';
    protected const PATH_PARAMS = array (
  0 => 'dataset_id',
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = true;
    protected const MULTIPART = true;
}
