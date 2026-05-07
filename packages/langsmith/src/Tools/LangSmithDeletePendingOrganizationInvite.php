<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Delete Pending Organization Invite.
 *
 * Maps to the official LangSmith endpoint DELETE /api/v1/orgs/pending/{organization_id}.
 */
class LangSmithDeletePendingOrganizationInvite extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_delete_pending_organization_invite';
    protected const DESCRIPTION = 'Delete Pending Organization Invite

Official endpoint: DELETE /api/v1/orgs/pending/{organization_id}
Delete Pending Organization Invite.';
    protected const PARAMETERS = array (
  'organization_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `organization_id`.',
  ),
);
    protected const METHOD = 'DELETE';
    protected const PATH = '/api/v1/orgs/pending/{organization_id}';
    protected const PATH_PARAMS = array (
  0 => 'organization_id',
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = false;
    protected const MULTIPART = false;
}
