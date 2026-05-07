<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Delete Current Org Pending Member.
 *
 * Maps to the official LangSmith endpoint DELETE /api/v1/orgs/current/members/{identity_id}/pending.
 */
class LangSmithDeleteCurrentOrgPendingMember extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_delete_current_org_pending_member';
    protected const DESCRIPTION = 'Delete Current Org Pending Member

Official endpoint: DELETE /api/v1/orgs/current/members/{identity_id}/pending
When an admin deletes a pending member invite.';
    protected const PARAMETERS = array (
  'identity_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `identity_id`.',
  ),
);
    protected const METHOD = 'DELETE';
    protected const PATH = '/api/v1/orgs/current/members/{identity_id}/pending';
    protected const PATH_PARAMS = array (
  0 => 'identity_id',
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = false;
    protected const MULTIPART = false;
}
