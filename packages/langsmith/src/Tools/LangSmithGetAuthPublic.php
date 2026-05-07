<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Get public auth info.
 *
 * Maps to the official LangSmith endpoint GET /auth/public.
 */
class LangSmithGetAuthPublic extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_get_auth_public';
    protected const DESCRIPTION = 'Get public auth info

Official endpoint: GET /auth/public
Returns public authentication information for the current workspace-level session.';
    protected const PARAMETERS = array (
);
    protected const METHOD = 'GET';
    protected const PATH = '/auth/public';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = false;
    protected const MULTIPART = false;
}
