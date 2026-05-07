<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Set Tenant Handle.
 *
 * Maps to the official LangSmith endpoint POST /api/v1/settings/handle.
 */
class LangSmithSetTenantHandle extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_set_tenant_handle';
    protected const DESCRIPTION = 'Set Tenant Handle

Official endpoint: POST /api/v1/settings/handle
Set tenant handle.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official LangSmith schema.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/api/v1/settings/handle';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = true;
    protected const MULTIPART = false;
}
