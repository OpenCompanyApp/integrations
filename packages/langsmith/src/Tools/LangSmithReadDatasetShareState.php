<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Read Dataset Share State.
 *
 * Maps to the official LangSmith endpoint GET /api/v1/datasets/{dataset_id}/share.
 */
class LangSmithReadDatasetShareState extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_read_dataset_share_state';
    protected const DESCRIPTION = 'Read Dataset Share State

Official endpoint: GET /api/v1/datasets/{dataset_id}/share
Get the state of sharing a dataset';
    protected const PARAMETERS = array (
  'dataset_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `dataset_id`.',
  ),
);
    protected const METHOD = 'GET';
    protected const PATH = '/api/v1/datasets/{dataset_id}/share';
    protected const PATH_PARAMS = array (
  0 => 'dataset_id',
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = false;
    protected const MULTIPART = false;
}
