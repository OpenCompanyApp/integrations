<?php

namespace OpenCompany\Integrations\Cloudflare\Tools;

/**
 * Execute a raw Cloudflare API PATCH request.
 *
 * Intended for specialized settings and product endpoints that are too broad
 * to model individually in this package.
 */
class CloudflareApiPatch extends AbstractCloudflareTool
{
    protected const NAME = 'cloudflare_api_patch';
    protected const DESCRIPTION = 'Execute a raw PATCH request against the Cloudflare API v4. Pass the JSON request body in `body`.';
    protected const PARAMETERS = [
        'path' => ['type' => 'string', 'required' => true, 'description' => 'Cloudflare API path, relative to /client/v4.'],
        'body' => ['type' => 'object', 'description' => 'JSON request body.'],
    ];
    protected const METHOD = 'PATCH';
    protected const PATH = '{path}';
    protected const REQUIRED = ['path'];
}
