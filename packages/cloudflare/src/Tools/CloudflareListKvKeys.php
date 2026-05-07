<?php

namespace OpenCompany\Integrations\Cloudflare\Tools;

/**
 * List keys in a Workers KV namespace.
 *
 * Supports cursor and prefix parameters for incremental scans.
 */
class CloudflareListKvKeys extends AbstractCloudflareTool
{
    protected const NAME = 'cloudflare_list_kv_keys';
    protected const DESCRIPTION = 'List keys in a Workers KV namespace.';
    protected const PARAMETERS = [
        'account_id' => ['type' => 'string', 'required' => true, 'description' => 'Cloudflare account identifier.'],
        'namespace_id' => ['type' => 'string', 'required' => true, 'description' => 'Workers KV namespace identifier.'],
        'prefix' => ['type' => 'string', 'description' => 'Only return keys with this prefix.'],
        'cursor' => ['type' => 'string', 'description' => 'Pagination cursor.'],
        'limit' => ['type' => 'integer', 'description' => 'Maximum keys to return.'],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/accounts/{account_id}/storage/kv/namespaces/{namespace_id}/keys';
    protected const REQUIRED = ['account_id', 'namespace_id'];
    protected const QUERY_KEYS = ['prefix', 'cursor', 'limit'];
}
