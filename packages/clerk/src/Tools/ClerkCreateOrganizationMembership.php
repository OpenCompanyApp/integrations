<?php

namespace OpenCompany\Integrations\Clerk\Tools;

/**
 * Create an organization membership.
 *
 * Adds a user to a Clerk organization with a role.
 */
class ClerkCreateOrganizationMembership extends AbstractClerkTool
{
    protected const NAME = 'clerk_create_organization_membership';
    protected const DESCRIPTION = 'Add a user to a Clerk organization with a role.';
    protected const PARAMETERS = [
        'organization_id' => ['type' => 'string', 'required' => true, 'description' => 'Clerk organization ID.'],
        'user_id' => ['type' => 'string', 'required' => true, 'description' => 'User ID to add.'],
        'role' => ['type' => 'string', 'required' => true, 'description' => 'Organization role, such as org:member.'],
        'body' => ['type' => 'object', 'description' => 'Raw membership create body.'],
    ];
    protected const METHOD = 'POST';
    protected const PATH = '/organizations/{organization_id}/memberships';
    protected const REQUIRED = ['organization_id', 'user_id', 'role'];
    protected const BODY_KEYS = ['user_id', 'role'];
    protected const BODY_REQUIRED = true;
}
