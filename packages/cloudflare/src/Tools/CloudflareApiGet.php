<?php

namespace OpenCompany\Integrations\Cloudflare\Tools;

/**
 * Execute a raw Cloudflare API GET request.
 *
 * Useful for newer or specialized Cloudflare API endpoints not yet represented
 * by a first-class tool.
 */
class CloudflareApiGet extends AbstractCloudflareTool
{
    protected const NAME = 'cloudflare_api_get';
    protected const DESCRIPTION = 'Execute a raw GET request against the Cloudflare API v4. Use relative paths such as `/zones/{zone_id}/settings`, and pass query parameters in `query`.';
    protected const PARAMETERS = [
        'path' => ['type' => 'string', 'required' => true, 'description' => 'Cloudflare API path, relative to /client/v4.'],
        'query' => ['type' => 'object', 'description' => 'Query string parameters.'],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '{path}';
    protected const REQUIRED = ['path'];
}
