<?php

namespace OpenCompany\Integrations\Clerk\Tools;

/**
 * List organization memberships.
 *
 * Retrieves members of a Clerk organization with pagination.
 */
class ClerkListOrganizationMemberships extends AbstractClerkTool
{
    protected const NAME = 'clerk_list_organization_memberships';
    protected const DESCRIPTION = 'List memberships for a Clerk organization.';
    protected const PARAMETERS = [
        'organization_id' => ['type' => 'string', 'required' => true, 'description' => 'Clerk organization ID.'],
        'limit' => ['type' => 'integer', 'description' => 'Maximum memberships to return.'],
        'offset' => ['type' => 'integer', 'description' => 'Pagination offset.'],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/organizations/{organization_id}/memberships';
    protected const REQUIRED = ['organization_id'];
    protected const QUERY_KEYS = ['limit', 'offset'];
}
