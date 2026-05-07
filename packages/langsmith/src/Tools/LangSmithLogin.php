<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Login.
 *
 * Maps to the official LangSmith endpoint POST /api/v1/login.
 */
class LangSmithLogin extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_login';
    protected const DESCRIPTION = 'Login

Official endpoint: POST /api/v1/login
Login.';
    protected const PARAMETERS = array (
);
    protected const METHOD = 'POST';
    protected const PATH = '/api/v1/login';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = false;
    protected const MULTIPART = false;
}
