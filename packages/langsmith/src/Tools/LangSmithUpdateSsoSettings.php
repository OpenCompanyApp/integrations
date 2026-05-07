<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Update Sso Settings.
 *
 * Maps to the official LangSmith endpoint PATCH /api/v1/orgs/current/sso-settings/{id}.
 */
class LangSmithUpdateSsoSettings extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_update_sso_settings';
    protected const DESCRIPTION = 'Update Sso Settings

Official endpoint: PATCH /api/v1/orgs/current/sso-settings/{id}
Update SSO provider settings defaults for the current organization.';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `id`.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official LangSmith schema.',
  ),
);
    protected const METHOD = 'PATCH';
    protected const PATH = '/api/v1/orgs/current/sso-settings/{id}';
    protected const PATH_PARAMS = array (
  0 => 'id',
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = true;
    protected const MULTIPART = false;
}
