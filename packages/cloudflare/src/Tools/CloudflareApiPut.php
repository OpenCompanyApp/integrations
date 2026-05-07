<?php

namespace OpenCompany\Integrations\Cloudflare\Tools;

/**
 * Execute a raw Cloudflare API PUT request.
 *
 * Useful for Cloudflare resources where PUT replaces a complete object.
 */
class CloudflareApiPut extends AbstractCloudflareTool
{
    protected const NAME = 'cloudflare_api_put';
    protected const DESCRIPTION = 'Execute a raw PUT request against the Cloudflare API v4. Pass the JSON request body in `body`.';
    protected const PARAMETERS = [
        'path' => ['type' => 'string', 'required' => true, 'description' => 'Cloudflare API path, relative to /client/v4.'],
        'body' => ['type' => 'object', 'description' => 'JSON request body.'],
    ];
    protected const METHOD = 'PUT';
    protected const PATH = '{path}';
    protected const REQUIRED = ['path'];
}
