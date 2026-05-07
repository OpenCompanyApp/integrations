<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Create Sso Settings.
 *
 * Maps to the official LangSmith endpoint POST /api/v1/orgs/current/sso-settings.
 */
class LangSmithCreateSsoSettings extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_create_sso_settings';
    protected const DESCRIPTION = 'Create Sso Settings

Official endpoint: POST /api/v1/orgs/current/sso-settings
Create SSO provider settings for the current organization.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official LangSmith schema.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/api/v1/orgs/current/sso-settings';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = true;
    protected const MULTIPART = false;
}
