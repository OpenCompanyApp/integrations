<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Update Model Price.
 *
 * Maps to the official LangSmith endpoint PUT /api/v1/model-price-map/{id}.
 */
class LangSmithUpdateModelPrice extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_update_model_price';
    protected const DESCRIPTION = 'Update Model Price

Official endpoint: PUT /api/v1/model-price-map/{id}
Update Model Price.';
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
    protected const METHOD = 'PUT';
    protected const PATH = '/api/v1/model-price-map/{id}';
    protected const PATH_PARAMS = array (
  0 => 'id',
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = true;
    protected const MULTIPART = false;
}
