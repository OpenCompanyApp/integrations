<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Claim Pending Organization Invite.
 *
 * Maps to the official LangSmith endpoint POST /api/v1/orgs/pending/{organization_id}/claim.
 */
class LangSmithClaimPendingOrganizationInvite extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_claim_pending_organization_invite';
    protected const DESCRIPTION = 'Claim Pending Organization Invite

Official endpoint: POST /api/v1/orgs/pending/{organization_id}/claim
Claim Pending Organization Invite.';
    protected const PARAMETERS = array (
  'organization_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `organization_id`.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/api/v1/orgs/pending/{organization_id}/claim';
    protected const PATH_PARAMS = array (
  0 => 'organization_id',
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = false;
    protected const MULTIPART = false;
}
