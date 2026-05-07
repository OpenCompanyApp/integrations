<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Update hub environments model.
 *
 * Maps to the official LangSmith endpoint PATCH /api/v1/hub/environments/{id}.
 */
class LangSmithPatch extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_patch';
    protected const DESCRIPTION = 'Update hub environments model

Official endpoint: PATCH /api/v1/hub/environments/{id}
Replaces the environments array on an existing model.';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `id`.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official LangSmith schema.',
  ),
);
    protected const METHOD = 'PATCH';
    protected const PATH = '/api/v1/hub/environments/{id}';
    protected const PATH_PARAMS = array (
  0 => 'id',
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = true;
    protected const MULTIPART = false;
}
