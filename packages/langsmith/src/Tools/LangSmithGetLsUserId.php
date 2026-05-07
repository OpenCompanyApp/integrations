<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Get Ls User Id.
 *
 * Maps to the official LangSmith endpoint GET /api/v1/me/ls_user_id.
 */
class LangSmithGetLsUserId extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_get_ls_user_id';
    protected const DESCRIPTION = 'Get Ls User Id

Official endpoint: GET /api/v1/me/ls_user_id
Get the LangSmith user ID for the current user.';
    protected const PARAMETERS = array (
);
    protected const METHOD = 'GET';
    protected const PATH = '/api/v1/me/ls_user_id';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = false;
    protected const MULTIPART = false;
}
