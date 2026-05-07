<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Update Dataset Version.
 *
 * Maps to the official LangSmith endpoint PUT /api/v1/datasets/{dataset_id}/tags.
 */
class LangSmithUpdateDatasetVersion extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_update_dataset_version';
    protected const DESCRIPTION = 'Update Dataset Version

Official endpoint: PUT /api/v1/datasets/{dataset_id}/tags
Set a tag on a dataset version.';
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
    protected const METHOD = 'PUT';
    protected const PATH = '/api/v1/datasets/{dataset_id}/tags';
    protected const PATH_PARAMS = array (
  0 => 'dataset_id',
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = true;
    protected const MULTIPART = false;
}
