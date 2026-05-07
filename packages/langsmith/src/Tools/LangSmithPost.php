<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Create hub environments model.
 *
 * Maps to the official LangSmith endpoint POST /api/v1/hub/environments.
 */
class LangSmithPost extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_post';
    protected const DESCRIPTION = 'Create hub environments model

Official endpoint: POST /api/v1/hub/environments
Creates the hub environments configuration for the current tenant.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official LangSmith schema.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/api/v1/hub/environments';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = true;
    protected const MULTIPART = false;
}
