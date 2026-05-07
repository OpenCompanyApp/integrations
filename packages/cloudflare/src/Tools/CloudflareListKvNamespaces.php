<?php

namespace OpenCompany\Integrations\Cloudflare\Tools;

/**
 * List Workers KV namespaces.
 *
 * Returns account-level KV namespace metadata.
 */
class CloudflareListKvNamespaces extends AbstractCloudflareTool
{
    protected const NAME = 'cloudflare_list_kv_namespaces';
    protected const DESCRIPTION = 'List Workers KV namespaces for a Cloudflare account.';
    protected const PARAMETERS = [
        'account_id' => ['type' => 'string', 'required' => true, 'description' => 'Cloudflare account identifier.'],
        'page' => ['type' => 'integer', 'description' => 'Page number.'],
        'per_page' => ['type' => 'integer', 'description' => 'Results per page.'],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/accounts/{account_id}/storage/kv/namespaces';
    protected const REQUIRED = ['account_id'];
    protected const QUERY_KEYS = ['page', 'per_page'];
}
