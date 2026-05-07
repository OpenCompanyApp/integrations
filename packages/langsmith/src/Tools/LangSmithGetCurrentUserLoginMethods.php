<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Get Current User Login Methods.
 *
 * Maps to the official LangSmith endpoint GET /api/v1/orgs/current/user/login-methods.
 */
class LangSmithGetCurrentUserLoginMethods extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_get_current_user_login_methods';
    protected const DESCRIPTION = 'Get Current User Login Methods

Official endpoint: GET /api/v1/orgs/current/user/login-methods
Get login methods for the current user.';
    protected const PARAMETERS = array (
);
    protected const METHOD = 'GET';
    protected const PATH = '/api/v1/orgs/current/user/login-methods';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = false;
    protected const MULTIPART = false;
}
