<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Delete Model Price.
 *
 * Maps to the official LangSmith endpoint DELETE /api/v1/model-price-map/{id}.
 */
class LangSmithDeleteModelPrice extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_delete_model_price';
    protected const DESCRIPTION = 'Delete Model Price

Official endpoint: DELETE /api/v1/model-price-map/{id}
Delete Model Price.';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `id`.',
  ),
);
    protected const METHOD = 'DELETE';
    protected const PATH = '/api/v1/model-price-map/{id}';
    protected const PATH_PARAMS = array (
  0 => 'id',
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = false;
    protected const MULTIPART = false;
}
