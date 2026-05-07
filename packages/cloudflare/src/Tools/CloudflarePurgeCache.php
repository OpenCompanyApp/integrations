<?php

namespace OpenCompany\Integrations\Cloudflare\Tools;

/**
 * Purge cached assets for a Cloudflare zone.
 *
 * Supports purge_everything and file/tag/host/prefix purge bodies.
 */
class CloudflarePurgeCache extends AbstractCloudflareTool
{
    protected const NAME = 'cloudflare_purge_cache';
    protected const DESCRIPTION = 'Purge Cloudflare cache for a zone. Pass purge_everything=true or files/tags/hosts/prefixes in body.';
    protected const PARAMETERS = [
        'zone_id' => ['type' => 'string', 'required' => true, 'description' => 'Cloudflare zone identifier.'],
        'purge_everything' => ['type' => 'boolean', 'description' => 'Purge all cached assets for the zone.'],
        'files' => ['type' => 'array', 'items' => ['type' => 'string'], 'description' => 'Specific URLs to purge.'],
        'tags' => ['type' => 'array', 'items' => ['type' => 'string'], 'description' => 'Cache tags to purge.'],
        'hosts' => ['type' => 'array', 'items' => ['type' => 'string'], 'description' => 'Hostnames to purge.'],
        'prefixes' => ['type' => 'array', 'items' => ['type' => 'string'], 'description' => 'URL prefixes to purge.'],
        'body' => ['type' => 'object', 'description' => 'Raw Cloudflare purge cache body.'],
    ];
    protected const METHOD = 'POST';
    protected const PATH = '/zones/{zone_id}/purge_cache';
    protected const REQUIRED = ['zone_id'];
    protected const BODY_KEYS = ['purge_everything', 'files', 'tags', 'hosts', 'prefixes'];
    protected const BODY_REQUIRED = true;
}
