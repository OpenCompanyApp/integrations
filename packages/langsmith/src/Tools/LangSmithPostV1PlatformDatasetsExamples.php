<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Hard Delete Examples.
 *
 * Maps to the official LangSmith endpoint POST /v1/platform/datasets/examples/delete.
 */
class LangSmithPostV1PlatformDatasetsExamples extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_post_v1_platform_datasets_examples';
    protected const DESCRIPTION = 'Hard Delete Examples

Official endpoint: POST /v1/platform/datasets/examples/delete
This endpoint hard deletes *all* versions of a dataset example(s). Deletion is performed by setting inputs, outputs, and metadata to null and deleting attachment files while keeping the example ID, dataset ID, and creation timestamp. IMPORTANT: attachment files can take up to 7 days to be deleted. inputs, outputs and metadata are nullified immediately.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official LangSmith schema.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/v1/platform/datasets/examples/delete';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = true;
    protected const MULTIPART = false;
}
