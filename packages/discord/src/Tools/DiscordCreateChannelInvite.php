<?php

namespace OpenCompany\Integrations\Discord\Tools;

/**
 * Create a channel invite.
 *
 * Creates an invite for a Discord channel with common invite fields.
 */
class DiscordCreateChannelInvite extends AbstractDiscordTool
{
    protected const NAME = 'discord_create_channel_invite';
    protected const DESCRIPTION = 'Create a Discord channel invite. Provide max_age, max_uses, temporary, unique, target_type, or raw body.';
    protected const PARAMETERS = [
        'channel_id' => ['type' => 'string', 'required' => true, 'description' => 'Channel ID.'],
        'max_age' => ['type' => 'integer', 'description' => 'Duration in seconds before expiry.'],
        'max_uses' => ['type' => 'integer', 'description' => 'Maximum uses.'],
        'temporary' => ['type' => 'boolean', 'description' => 'Whether invite grants temporary membership.'],
        'unique' => ['type' => 'boolean', 'description' => 'Whether to create a unique invite.'],
        'target_type' => ['type' => 'integer', 'description' => 'Invite target type.'],
        'target_user_id' => ['type' => 'string', 'description' => 'Target user ID.'],
        'target_application_id' => ['type' => 'string', 'description' => 'Target application ID.'],
        'body' => ['type' => 'object', 'description' => 'Raw Discord invite create body.'],
    ];
    protected const METHOD = 'POST';
    protected const PATH = '/channels/{channel_id}/invites';
    protected const REQUIRED = ['channel_id'];
    protected const BODY_KEYS = ['max_age', 'max_uses', 'temporary', 'unique', 'target_type', 'target_user_id', 'target_application_id'];
}
