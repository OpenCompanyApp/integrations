<?php

namespace OpenCompany\Integrations\Cloudflare\Tools;

/**
 * Execute a raw Cloudflare API DELETE request.
 *
 * Allows agents to call delete endpoints while dedicated destructive tools
 * remain explicit for common Cloudflare objects.
 */
class CloudflareApiDelete extends AbstractCloudflareTool
{
    protected const NAME = 'cloudflare_api_delete';
    protected const DESCRIPTION = 'Execute a raw DELETE request against the Cloudflare API v4. Pass an optional JSON request body in `body`.';
    protected const PARAMETERS = [
        'path' => ['type' => 'string', 'required' => true, 'description' => 'Cloudflare API path, relative to /client/v4.'],
        'body' => ['type' => 'object', 'description' => 'Optional JSON request body.'],
    ];
    protected const METHOD = 'DELETE';
    protected const PATH = '{path}';
    protected const REQUIRED = ['path'];
}
