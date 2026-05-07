<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Delete Org Personal Access Token.
 *
 * Maps to the official LangSmith endpoint DELETE /api/v1/orgs/current/personal-access-tokens/{pat_id}.
 */
class LangSmithDeleteOrgPersonalAccessToken extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_delete_org_personal_access_token';
    protected const DESCRIPTION = 'Delete Org Personal Access Token

Official endpoint: DELETE /api/v1/orgs/current/personal-access-tokens/{pat_id}
Delete Org Personal Access Token.';
    protected const PARAMETERS = array (
  'pat_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `pat_id`.',
  ),
);
    protected const METHOD = 'DELETE';
    protected const PATH = '/api/v1/orgs/current/personal-access-tokens/{pat_id}';
    protected const PATH_PARAMS = array (
  0 => 'pat_id',
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = false;
    protected const MULTIPART = false;
}
