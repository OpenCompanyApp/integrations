<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Diff Dataset Versions.
 *
 * Maps to the official LangSmith endpoint GET /api/v1/datasets/{dataset_id}/versions/diff.
 */
class LangSmithDiffDatasetVersions extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_diff_dataset_versions';
    protected const DESCRIPTION = 'Diff Dataset Versions

Official endpoint: GET /api/v1/datasets/{dataset_id}/versions/diff
Get diff between two dataset versions.';
    protected const PARAMETERS = array (
  'dataset_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `dataset_id`.',
  ),
  'query' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Query string parameters. Known keys: from_version, to_version.',
  ),
  'from_version' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `from_version`.',
  ),
  'to_version' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `to_version`.',
  ),
);
    protected const METHOD = 'GET';
    protected const PATH = '/api/v1/datasets/{dataset_id}/versions/diff';
    protected const PATH_PARAMS = array (
  0 => 'dataset_id',
);
    protected const QUERY_KEYS = array (
  0 => 'from_version',
  1 => 'to_version',
);
    protected const BODY_REQUIRED = false;
    protected const MULTIPART = false;
}
