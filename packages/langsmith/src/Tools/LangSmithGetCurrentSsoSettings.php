<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Get Current Sso Settings.
 *
 * Maps to the official LangSmith endpoint GET /api/v1/orgs/current/sso-settings.
 */
class LangSmithGetCurrentSsoSettings extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_get_current_sso_settings';
    protected const DESCRIPTION = 'Get Current Sso Settings

Official endpoint: GET /api/v1/orgs/current/sso-settings
Get SSO provider settings for the current organization.';
    protected const PARAMETERS = array (
);
    protected const METHOD = 'GET';
    protected const PATH = '/api/v1/orgs/current/sso-settings';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = false;
    protected const MULTIPART = false;
}
