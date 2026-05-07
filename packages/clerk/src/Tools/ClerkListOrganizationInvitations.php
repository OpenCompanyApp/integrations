<?php

namespace OpenCompany\Integrations\Clerk\Tools;

/**
 * List organization invitations.
 *
 * Retrieves pending and historical invitations for a Clerk organization.
 */
class ClerkListOrganizationInvitations extends AbstractClerkTool
{
    protected const NAME = 'clerk_list_organization_invitations';
    protected const DESCRIPTION = 'List invitations for a Clerk organization.';
    protected const PARAMETERS = [
        'organization_id' => ['type' => 'string', 'required' => true, 'description' => 'Clerk organization ID.'],
        'limit' => ['type' => 'integer', 'description' => 'Maximum invitations to return.'],
        'offset' => ['type' => 'integer', 'description' => 'Pagination offset.'],
        'status' => ['type' => 'string', 'description' => 'Invitation status filter.'],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/organizations/{organization_id}/invitations';
    protected const REQUIRED = ['organization_id'];
    protected const QUERY_KEYS = ['limit', 'offset', 'status'];
}
