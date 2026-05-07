<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Remove Member From Current Org.
 *
 * Maps to the official LangSmith endpoint DELETE /api/v1/orgs/current/members/{identity_id}.
 */
class LangSmithRemoveMemberFromCurrentOrg extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_remove_member_from_current_org';
    protected const DESCRIPTION = 'Remove Member From Current Org

Official endpoint: DELETE /api/v1/orgs/current/members/{identity_id}
Remove a user from the current organization.';
    protected const PARAMETERS = array (
  'identity_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `identity_id`.',
  ),
);
    protected const METHOD = 'DELETE';
    protected const PATH = '/api/v1/orgs/current/members/{identity_id}';
    protected const PATH_PARAMS = array (
  0 => 'identity_id',
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = false;
    protected const MULTIPART = false;
}
