<?php

namespace OpenCompany\Integrations\Cloudflare\Tools;

/**
 * Create a Cloudflare zone.
 *
 * Adds a domain to Cloudflare under an account.
 */
class CloudflareCreateZone extends AbstractCloudflareTool
{
    protected const NAME = 'cloudflare_create_zone';
    protected const DESCRIPTION = 'Create a Cloudflare zone. Requires name and account object or raw body matching Cloudflare zone create parameters.';
    protected const PARAMETERS = [
        'name' => ['type' => 'string', 'required' => true, 'description' => 'Zone name, for example example.com.'],
        'account' => ['type' => 'object', 'description' => 'Cloudflare account object, usually `{id: account_id}`.'],
        'type' => ['type' => 'string', 'description' => 'Zone type, such as full or partial.'],
        'body' => ['type' => 'object', 'description' => 'Raw Cloudflare zone create body.'],
    ];
    protected const METHOD = 'POST';
    protected const PATH = '/zones';
    protected const REQUIRED = ['name'];
    protected const BODY_KEYS = ['name', 'account', 'type'];
    protected const BODY_REQUIRED = true;
}
