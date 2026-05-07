<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Create Org Service Key.
 *
 * Maps to the official LangSmith endpoint POST /api/v1/orgs/current/service-keys.
 */
class LangSmithCreateOrgServiceKey extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_create_org_service_key';
    protected const DESCRIPTION = 'Create Org Service Key

Official endpoint: POST /api/v1/orgs/current/service-keys
Create org-scoped service key. If workspaces is None, key is org-wide.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official LangSmith schema.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/api/v1/orgs/current/service-keys';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = true;
    protected const MULTIPART = false;
}
