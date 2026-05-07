<?php

namespace OpenCompany\Integrations\Clerk\Tools;

/**
 * Execute a raw Clerk Backend API POST request.
 *
 * Useful for newer Clerk Backend API endpoints not yet modeled as first-class tools.
 */
class ClerkApiPost extends AbstractClerkTool
{
    protected const NAME = 'clerk_api_post';
    protected const DESCRIPTION = 'Execute a raw POST request against the Clerk Backend API. Pass JSON payload in body.';
    protected const PARAMETERS = [
        'path' => ['type' => 'string', 'required' => true, 'description' => 'Clerk Backend API path relative to /v1.'],
        'body' => ['type' => 'object', 'description' => 'JSON request body.'],
    ];
    protected const METHOD = 'POST';
    protected const PATH = '{path}';
    protected const REQUIRED = ['path'];
}
