<?php

namespace OpenCompany\Integrations\Clerk\Tools;

/**
 * Create a Clerk organization.
 *
 * Creates an organization with common fields or a raw body.
 */
class ClerkCreateOrganization extends AbstractClerkTool
{
    protected const NAME = 'clerk_create_organization';
    protected const DESCRIPTION = 'Create a Clerk organization. Provide name, created_by, metadata, or raw body.';
    protected const PARAMETERS = [
        'name' => ['type' => 'string', 'required' => true, 'description' => 'Organization name.'],
        'created_by' => ['type' => 'string', 'description' => 'User ID that creates the organization.'],
        'slug' => ['type' => 'string', 'description' => 'Organization slug.'],
        'public_metadata' => ['type' => 'object', 'description' => 'Public metadata.'],
        'private_metadata' => ['type' => 'object', 'description' => 'Private metadata.'],
        'body' => ['type' => 'object', 'description' => 'Raw Clerk organization create body.'],
    ];
    protected const METHOD = 'POST';
    protected const PATH = '/organizations';
    protected const REQUIRED = ['name'];
    protected const BODY_KEYS = ['name', 'created_by', 'slug', 'public_metadata', 'private_metadata'];
    protected const BODY_REQUIRED = true;
}
