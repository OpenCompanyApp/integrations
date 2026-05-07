<?php

namespace OpenCompany\Integrations\Cloudflare\Tools;

/**
 * Update one Cloudflare zone setting.
 *
 * Sends the Cloudflare settings API value body for a single setting.
 */
class CloudflareUpdateZoneSetting extends AbstractCloudflareTool
{
    protected const NAME = 'cloudflare_update_zone_setting';
    protected const DESCRIPTION = 'Update one Cloudflare zone setting by setting_id. Provide value or raw body.';
    protected const PARAMETERS = [
        'zone_id' => ['type' => 'string', 'required' => true, 'description' => 'Cloudflare zone identifier.'],
        'setting_id' => ['type' => 'string', 'required' => true, 'description' => 'Zone setting identifier.'],
        'value' => ['type' => 'string', 'description' => 'Setting value. Use body for non-string values.'],
        'body' => ['type' => 'object', 'description' => 'Raw Cloudflare setting update body.'],
    ];
    protected const METHOD = 'PATCH';
    protected const PATH = '/zones/{zone_id}/settings/{setting_id}';
    protected const REQUIRED = ['zone_id', 'setting_id'];
    protected const BODY_KEYS = ['value'];
    protected const BODY_REQUIRED = true;
}
