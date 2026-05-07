<?php

namespace OpenCompany\Integrations\Cloudflare\Tools;

/**
 * Get one Cloudflare zone setting.
 *
 * Examples include ssl, cache_level, development_mode, and always_use_https.
 */
class CloudflareGetZoneSetting extends AbstractCloudflareTool
{
    protected const NAME = 'cloudflare_get_zone_setting';
    protected const DESCRIPTION = 'Get one Cloudflare zone setting by setting_id, such as ssl, cache_level, or development_mode.';
    protected const PARAMETERS = [
        'zone_id' => ['type' => 'string', 'required' => true, 'description' => 'Cloudflare zone identifier.'],
        'setting_id' => ['type' => 'string', 'required' => true, 'description' => 'Zone setting identifier.'],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/zones/{zone_id}/settings/{setting_id}';
    protected const REQUIRED = ['zone_id', 'setting_id'];
}
