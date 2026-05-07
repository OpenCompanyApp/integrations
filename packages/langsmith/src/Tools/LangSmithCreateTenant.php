<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Create Tenant.
 *
 * Maps to the official LangSmith endpoint POST /api/v1/tenants.
 */
class LangSmithCreateTenant extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_create_tenant';
    protected const DESCRIPTION = 'Create Tenant

Official endpoint: POST /api/v1/tenants
Create a new organization and corresponding workspace.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official LangSmith schema.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/api/v1/tenants';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = true;
    protected const MULTIPART = false;
}
