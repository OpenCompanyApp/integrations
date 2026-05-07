<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Create Service Account.
 *
 * Maps to the official LangSmith endpoint POST /api/v1/service-accounts.
 */
class LangSmithCreateServiceAccount extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_create_service_account';
    protected const DESCRIPTION = 'Create Service Account

Official endpoint: POST /api/v1/service-accounts
Create a service account';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official LangSmith schema.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/api/v1/service-accounts';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = true;
    protected const MULTIPART = false;
}
