<?php

namespace OpenCompany\Integrations\Clerk\Tools;

/**
 * Delete an organization membership.
 *
 * Removes a user from a Clerk organization.
 */
class ClerkDeleteOrganizationMembership extends AbstractClerkTool
{
    protected const NAME = 'clerk_delete_organization_membership';
    protected const DESCRIPTION = 'Remove a user from a Clerk organization.';
    protected const PARAMETERS = [
        'organization_id' => ['type' => 'string', 'required' => true, 'description' => 'Clerk organization ID.'],
        'user_id' => ['type' => 'string', 'required' => true, 'description' => 'User ID.'],
    ];
    protected const METHOD = 'DELETE';
    protected const PATH = '/organizations/{organization_id}/memberships/{user_id}';
    protected const REQUIRED = ['organization_id', 'user_id'];
}
