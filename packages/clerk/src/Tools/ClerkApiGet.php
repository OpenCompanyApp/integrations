<?php

namespace OpenCompany\Integrations\Clerk\Tools;

/**
 * Execute a raw Clerk Backend API GET request.
 *
 * Provides long-tail coverage for Clerk Backend API endpoints.
 */
class ClerkApiGet extends AbstractClerkTool
{
    protected const NAME = 'clerk_api_get';
    protected const DESCRIPTION = 'Execute a raw GET request against the Clerk Backend API. Use paths such as `/sessions` and pass query in query.';
    protected const PARAMETERS = [
        'path' => ['type' => 'string', 'required' => true, 'description' => 'Clerk Backend API path relative to /v1.'],
        'query' => ['type' => 'object', 'description' => 'Query string parameters.'],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '{path}';
    protected const REQUIRED = ['path'];
}
