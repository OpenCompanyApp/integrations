<?php

namespace OpenCompany\Integrations\Cloudflare\Tools;

/**
 * Edit a Cloudflare zone.
 *
 * Updates mutable zone fields such as paused state or plan metadata.
 */
class CloudflareEditZone extends AbstractCloudflareTool
{
    protected const NAME = 'cloudflare_edit_zone';
    protected const DESCRIPTION = 'Edit a Cloudflare zone with PATCH /zones/{zone_id}. Pass changed fields in body.';
    protected const PARAMETERS = [
        'zone_id' => ['type' => 'string', 'required' => true, 'description' => 'Cloudflare zone identifier.'],
        'paused' => ['type' => 'boolean', 'description' => 'Whether the zone is paused.'],
        'type' => ['type' => 'string', 'description' => 'Zone type.'],
        'body' => ['type' => 'object', 'description' => 'Raw Cloudflare zone update body.'],
    ];
    protected const METHOD = 'PATCH';
    protected const PATH = '/zones/{zone_id}';
    protected const REQUIRED = ['zone_id'];
    protected const BODY_KEYS = ['paused', 'type'];
    protected const BODY_REQUIRED = true;
}
