<?php

namespace OpenCompany\Integrations\Clerk\Tools;

/**
 * Execute a raw Clerk Backend API DELETE request.
 *
 * Allows agents to call delete endpoints while destructive common actions remain explicit.
 */
class ClerkApiDelete extends AbstractClerkTool
{
    protected const NAME = 'clerk_api_delete';
    protected const DESCRIPTION = 'Execute a raw DELETE request against the Clerk Backend API. Pass optional JSON payload in body.';
    protected const PARAMETERS = [
        'path' => ['type' => 'string', 'required' => true, 'description' => 'Clerk Backend API path relative to /v1.'],
        'body' => ['type' => 'object', 'description' => 'Optional JSON request body.'],
    ];
    protected const METHOD = 'DELETE';
    protected const PATH = '{path}';
    protected const REQUIRED = ['path'];
}
