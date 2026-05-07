<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Upload Examples.
 *
 * Maps to the official LangSmith endpoint POST /v1/platform/datasets/{dataset_id}/examples.
 */
class LangSmithPostV1PlatformDatasetsDatasetIdExamples extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_post_v1_platform_datasets_dataset_id_examples';
    protected const DESCRIPTION = 'Upload Examples

Official endpoint: POST /v1/platform/datasets/{dataset_id}/examples
This endpoint allows clients to upload examples to a specified dataset by sending a multipart/form-data POST request. Each form part contains either JSON-encoded data or binary attachment files associated with an example.';
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
    protected const PATH = '/v1/platform/datasets/{dataset_id}/examples';
    protected const PATH_PARAMS = array (
  0 => 'dataset_id',
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = true;
    protected const MULTIPART = true;
}
