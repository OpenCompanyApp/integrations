<?php

namespace OpenCompany\Integrations\Cloudflare\Tools;

/**
 * Verify the current Cloudflare API token.
 *
 * Calls the token verification endpoint and returns token status metadata.
 */
class CloudflareVerifyToken extends AbstractCloudflareTool
{
    protected const NAME = 'cloudflare_verify_token';
    protected const DESCRIPTION = 'Verify the current Cloudflare API token and return token status metadata.';
    protected const PARAMETERS = [];
    protected const METHOD = 'GET';
    protected const PATH = '/user/tokens/verify';
}
