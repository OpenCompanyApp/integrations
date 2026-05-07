<?php

namespace OpenCompany\Integrations\Cloudflare\Tools;

/**
 * Delete a Workers KV namespace.
 *
 * Removes an account-level KV namespace.
 */
class CloudflareDeleteKvNamespace extends AbstractCloudflareTool
{
    protected const NAME = 'cloudflare_delete_kv_namespace';
    protected const DESCRIPTION = 'Delete a Workers KV namespace.';
    protected const PARAMETERS = [
        'account_id' => ['type' => 'string', 'required' => true, 'description' => 'Cloudflare account identifier.'],
        'namespace_id' => ['type' => 'string', 'required' => true, 'description' => 'Workers KV namespace identifier.'],
    ];
    protected const METHOD = 'DELETE';
    protected const PATH = '/accounts/{account_id}/storage/kv/namespaces/{namespace_id}';
    protected const REQUIRED = ['account_id', 'namespace_id'];
}
