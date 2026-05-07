<?php

namespace OpenCompany\Integrations\Cloudflare\Tools;

/**
 * Create a Workers KV namespace.
 *
 * Creates an account-level KV namespace with the supplied title.
 */
class CloudflareCreateKvNamespace extends AbstractCloudflareTool
{
    protected const NAME = 'cloudflare_create_kv_namespace';
    protected const DESCRIPTION = 'Create a Workers KV namespace for a Cloudflare account.';
    protected const PARAMETERS = [
        'account_id' => ['type' => 'string', 'required' => true, 'description' => 'Cloudflare account identifier.'],
        'title' => ['type' => 'string', 'required' => true, 'description' => 'KV namespace title.'],
        'body' => ['type' => 'object', 'description' => 'Raw KV namespace create body.'],
    ];
    protected const METHOD = 'POST';
    protected const PATH = '/accounts/{account_id}/storage/kv/namespaces';
    protected const REQUIRED = ['account_id', 'title'];
    protected const BODY_KEYS = ['title'];
    protected const BODY_REQUIRED = true;
}
