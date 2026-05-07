<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Clone Dataset.
 *
 * Maps to the official LangSmith endpoint POST /api/v1/datasets/clone.
 */
class LangSmithCloneDataset extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_clone_dataset';
    protected const DESCRIPTION = 'Clone Dataset

Official endpoint: POST /api/v1/datasets/clone
Clone a dataset.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official LangSmith schema.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/api/v1/datasets/clone';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = true;
    protected const MULTIPART = false;
}
