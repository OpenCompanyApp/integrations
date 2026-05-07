<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Update Examples.
 *
 * Maps to the official LangSmith endpoint PATCH /v1/platform/datasets/{dataset_id}/examples.
 */
class LangSmithPatchV1PlatformDatasetsDatasetIdExamples extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_patch_v1_platform_datasets_dataset_id_examples';
    protected const DESCRIPTION = 'Update Examples

Official endpoint: PATCH /v1/platform/datasets/{dataset_id}/examples
This endpoint allows clients to update existing examples in a specified dataset by sending a multipart/form-data PATCH request. Each form part contains either JSON-encoded data or binary attachment files to update an example.';
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
    protected const METHOD = 'PATCH';
    protected const PATH = '/v1/platform/datasets/{dataset_id}/examples';
    protected const PATH_PARAMS = array (
  0 => 'dataset_id',
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = true;
    protected const MULTIPART = true;
}
