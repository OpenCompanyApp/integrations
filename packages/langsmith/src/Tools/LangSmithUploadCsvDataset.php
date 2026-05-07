<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Upload Csv Dataset.
 *
 * Maps to the official LangSmith endpoint POST /api/v1/datasets/upload.
 */
class LangSmithUploadCsvDataset extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_upload_csv_dataset';
    protected const DESCRIPTION = 'Upload Csv Dataset

Official endpoint: POST /api/v1/datasets/upload
Create a new dataset from a CSV or JSONL file.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'Multipart form fields. Use file_path for a local upload file when required.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/api/v1/datasets/upload';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = true;
    protected const MULTIPART = true;
}
