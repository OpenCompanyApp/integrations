<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Update Current Org Member.
 *
 * Maps to the official LangSmith endpoint PATCH /api/v1/orgs/current/members/{identity_id}.
 */
class LangSmithUpdateCurrentOrgMember extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_update_current_org_member';
    protected const DESCRIPTION = 'Update Current Org Member

Official endpoint: PATCH /api/v1/orgs/current/members/{identity_id}
This is used for updating a user\'s role (all auth modes) or full_name/password (basic auth)';
    protected const PARAMETERS = array (
  'identity_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `identity_id`.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official LangSmith schema.',
  ),
);
    protected const METHOD = 'PATCH';
    protected const PATH = '/api/v1/orgs/current/members/{identity_id}';
    protected const PATH_PARAMS = array (
  0 => 'identity_id',
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = true;
    protected const MULTIPART = false;
}
