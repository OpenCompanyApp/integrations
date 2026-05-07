<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Share Dataset.
 *
 * Maps to the official LangSmith endpoint PUT /api/v1/datasets/{dataset_id}/share.
 */
class LangSmithShareDataset extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_share_dataset';
    protected const DESCRIPTION = 'Share Dataset

Official endpoint: PUT /api/v1/datasets/{dataset_id}/share
Share a dataset.';
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
    'description' => 'Query string parameters. Known keys: share_projects.',
  ),
  'share_projects' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `share_projects`.',
  ),
);
    protected const METHOD = 'PUT';
    protected const PATH = '/api/v1/datasets/{dataset_id}/share';
    protected const PATH_PARAMS = array (
  0 => 'dataset_id',
);
    protected const QUERY_KEYS = array (
  0 => 'share_projects',
);
    protected const BODY_REQUIRED = false;
    protected const MULTIPART = false;
}
