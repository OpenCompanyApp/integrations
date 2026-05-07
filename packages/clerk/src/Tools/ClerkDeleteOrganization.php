<?php

namespace OpenCompany\Integrations\Clerk\Tools;

/**
 * Delete a Clerk organization.
 *
 * Removes an organization by ID.
 */
class ClerkDeleteOrganization extends AbstractClerkTool
{
    protected const NAME = 'clerk_delete_organization';
    protected const DESCRIPTION = 'Delete a Clerk organization by organization_id.';
    protected const PARAMETERS = [
        'organization_id' => ['type' => 'string', 'required' => true, 'description' => 'Clerk organization ID.'],
    ];
    protected const METHOD = 'DELETE';
    protected const PATH = '/organizations/{organization_id}';
    protected const REQUIRED = ['organization_id'];
}
