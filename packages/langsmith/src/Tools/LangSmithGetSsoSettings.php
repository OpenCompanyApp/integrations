<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Get Sso Settings.
 *
 * Maps to the official LangSmith endpoint GET /api/v1/sso/settings/{sso_login_slug}.
 */
class LangSmithGetSsoSettings extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_get_sso_settings';
    protected const DESCRIPTION = 'Get Sso Settings

Official endpoint: GET /api/v1/sso/settings/{sso_login_slug}
Get SSO provider settings from login slug.';
    protected const PARAMETERS = array (
  'sso_login_slug' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `sso_login_slug`.',
  ),
);
    protected const METHOD = 'GET';
    protected const PATH = '/api/v1/sso/settings/{sso_login_slug}';
    protected const PATH_PARAMS = array (
  0 => 'sso_login_slug',
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = false;
    protected const MULTIPART = false;
}
