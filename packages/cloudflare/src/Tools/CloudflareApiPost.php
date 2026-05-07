<?php

namespace OpenCompany\Integrations\Cloudflare\Tools;

/**
 * Execute a raw Cloudflare API POST request.
 *
 * Provides long-tail coverage for Cloudflare API endpoints while dedicated
 * tools cover common zone, DNS, ruleset, and account workflows.
 */
class CloudflareApiPost extends AbstractCloudflareTool
{
    protected const NAME = 'cloudflare_api_post';
    protected const DESCRIPTION = 'Execute a raw POST request against the Cloudflare API v4. Pass the JSON request body in `body`.';
    protected const PARAMETERS = [
        'path' => ['type' => 'string', 'required' => true, 'description' => 'Cloudflare API path, relative to /client/v4.'],
        'body' => ['type' => 'object', 'description' => 'JSON request body.'],
    ];
    protected const METHOD = 'POST';
    protected const PATH = '{path}';
    protected const REQUIRED = ['path'];
}
