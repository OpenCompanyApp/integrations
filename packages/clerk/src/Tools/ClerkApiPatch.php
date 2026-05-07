<?php

namespace OpenCompany\Integrations\Clerk\Tools;

/**
 * Execute a raw Clerk Backend API PATCH request.
 *
 * Supports long-tail update endpoints while common resources have first-class tools.
 */
class ClerkApiPatch extends AbstractClerkTool
{
    protected const NAME = 'clerk_api_patch';
    protected const DESCRIPTION = 'Execute a raw PATCH request against the Clerk Backend API. Pass JSON payload in body.';
    protected const PARAMETERS = [
        'path' => ['type' => 'string', 'required' => true, 'description' => 'Clerk Backend API path relative to /v1.'],
        'body' => ['type' => 'object', 'description' => 'JSON request body.'],
    ];
    protected const METHOD = 'PATCH';
    protected const PATH = '{path}';
    protected const REQUIRED = ['path'];
}
