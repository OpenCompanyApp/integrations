<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Delete Sso Settings.
 *
 * Maps to the official LangSmith endpoint DELETE /api/v1/orgs/current/sso-settings/{id}.
 */
class LangSmithDeleteSsoSettings extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_delete_sso_settings';
    protected const DESCRIPTION = 'Delete Sso Settings

Official endpoint: DELETE /api/v1/orgs/current/sso-settings/{id}
Delete SSO provider settings for the current organization.';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `id`.',
  ),
);
    protected const METHOD = 'DELETE';
    protected const PATH = '/api/v1/orgs/current/sso-settings/{id}';
    protected const PATH_PARAMS = array (
  0 => 'id',
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = false;
    protected const MULTIPART = false;
}
