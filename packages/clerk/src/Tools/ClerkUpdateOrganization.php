<?php

namespace OpenCompany\Integrations\Clerk\Tools;

/**
 * Update a Clerk organization.
 *
 * Updates organization profile fields and metadata.
 */
class ClerkUpdateOrganization extends AbstractClerkTool
{
    protected const NAME = 'clerk_update_organization';
    protected const DESCRIPTION = 'Update a Clerk organization. Provide changed fields or raw body.';
    protected const PARAMETERS = [
        'organization_id' => ['type' => 'string', 'required' => true, 'description' => 'Clerk organization ID.'],
        'name' => ['type' => 'string', 'description' => 'Organization name.'],
        'slug' => ['type' => 'string', 'description' => 'Organization slug.'],
        'public_metadata' => ['type' => 'object', 'description' => 'Public metadata.'],
        'private_metadata' => ['type' => 'object', 'description' => 'Private metadata.'],
        'body' => ['type' => 'object', 'description' => 'Raw Clerk organization update body.'],
    ];
    protected const METHOD = 'PATCH';
    protected const PATH = '/organizations/{organization_id}';
    protected const REQUIRED = ['organization_id'];
    protected const BODY_KEYS = ['name', 'slug', 'public_metadata', 'private_metadata'];
    protected const BODY_REQUIRED = true;
}
