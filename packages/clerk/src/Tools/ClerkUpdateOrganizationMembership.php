<?php

namespace OpenCompany\Integrations\Clerk\Tools;

/**
 * Update an organization membership.
 *
 * Changes a user's role in a Clerk organization.
 */
class ClerkUpdateOrganizationMembership extends AbstractClerkTool
{
    protected const NAME = 'clerk_update_organization_membership';
    protected const DESCRIPTION = 'Update a Clerk organization membership, commonly to change role.';
    protected const PARAMETERS = [
        'organization_id' => ['type' => 'string', 'required' => true, 'description' => 'Clerk organization ID.'],
        'user_id' => ['type' => 'string', 'required' => true, 'description' => 'User ID.'],
        'role' => ['type' => 'string', 'required' => true, 'description' => 'New organization role.'],
        'body' => ['type' => 'object', 'description' => 'Raw membership update body.'],
    ];
    protected const METHOD = 'PATCH';
    protected const PATH = '/organizations/{organization_id}/memberships/{user_id}';
    protected const REQUIRED = ['organization_id', 'user_id', 'role'];
    protected const BODY_KEYS = ['role'];
    protected const BODY_REQUIRED = true;
}
