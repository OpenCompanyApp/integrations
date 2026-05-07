<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Delete Service Account.
 *
 * Maps to the official LangSmith endpoint DELETE /api/v1/service-accounts/{service_account_id}.
 */
class LangSmithDeleteServiceAccount extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_delete_service_account';
    protected const DESCRIPTION = 'Delete Service Account

Official endpoint: DELETE /api/v1/service-accounts/{service_account_id}
Delete a service account';
    protected const PARAMETERS = array (
  'service_account_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `service_account_id`.',
  ),
);
    protected const METHOD = 'DELETE';
    protected const PATH = '/api/v1/service-accounts/{service_account_id}';
    protected const PATH_PARAMS = array (
  0 => 'service_account_id',
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = false;
    protected const MULTIPART = false;
}
