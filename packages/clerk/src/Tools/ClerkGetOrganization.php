<?php

namespace OpenCompany\Integrations\Clerk\Tools;

/**
 * Get a Clerk organization.
 *
 * Retrieves one organization by ID.
 */
class ClerkGetOrganization extends AbstractClerkTool
{
    protected const NAME = 'clerk_get_organization';
    protected const DESCRIPTION = 'Get a Clerk organization by organization_id.';
    protected const PARAMETERS = [
        'organization_id' => ['type' => 'string', 'required' => true, 'description' => 'Clerk organization ID.'],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/organizations/{organization_id}';
    protected const REQUIRED = ['organization_id'];
}
