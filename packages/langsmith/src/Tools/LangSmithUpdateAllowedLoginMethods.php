<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Update Allowed Login Methods.
 *
 * Maps to the official LangSmith endpoint PATCH /api/v1/orgs/current/login-methods.
 */
class LangSmithUpdateAllowedLoginMethods extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_update_allowed_login_methods';
    protected const DESCRIPTION = 'Update Allowed Login Methods

Official endpoint: PATCH /api/v1/orgs/current/login-methods
Update allowed login methods for the current organization.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official LangSmith schema.',
  ),
);
    protected const METHOD = 'PATCH';
    protected const PATH = '/api/v1/orgs/current/login-methods';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = true;
    protected const MULTIPART = false;
}
