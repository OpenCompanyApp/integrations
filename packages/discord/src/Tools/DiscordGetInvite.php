<?php

namespace OpenCompany\Integrations\Discord\Tools;

/**
 * Get a Discord invite.
 *
 * Retrieves one invite by invite code.
 */
class DiscordGetInvite extends AbstractDiscordTool
{
    protected const NAME = 'discord_get_invite';
    protected const DESCRIPTION = 'Get a Discord invite by invite code.';
    protected const PARAMETERS = [
        'invite_code' => ['type' => 'string', 'required' => true, 'description' => 'Invite code.'],
        'with_counts' => ['type' => 'boolean', 'description' => 'Include approximate member counts.'],
        'with_expiration' => ['type' => 'boolean', 'description' => 'Include expiration date.'],
        'guild_scheduled_event_id' => ['type' => 'string', 'description' => 'Scheduled event ID.'],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/invites/{invite_code}';
    protected const REQUIRED = ['invite_code'];
    protected const QUERY_KEYS = ['with_counts', 'with_expiration', 'guild_scheduled_event_id'];
}
