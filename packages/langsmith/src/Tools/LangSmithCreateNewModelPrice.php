<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Create New Model Price.
 *
 * Maps to the official LangSmith endpoint POST /api/v1/model-price-map.
 */
class LangSmithCreateNewModelPrice extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_create_new_model_price';
    protected const DESCRIPTION = 'Create New Model Price

Official endpoint: POST /api/v1/model-price-map
Create New Model Price.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official LangSmith schema.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/api/v1/model-price-map';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = true;
    protected const MULTIPART = false;
}
