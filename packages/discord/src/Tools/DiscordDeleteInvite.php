<?php

namespace OpenCompany\Integrations\Discord\Tools;

/**
 * Delete a Discord invite.
 *
 * Revokes an invite by invite code.
 */
class DiscordDeleteInvite extends AbstractDiscordTool
{
    protected const NAME = 'discord_delete_invite';
    protected const DESCRIPTION = 'Delete a Discord invite by invite code.';
    protected const PARAMETERS = [
        'invite_code' => ['type' => 'string', 'required' => true, 'description' => 'Invite code.'],
    ];
    protected const METHOD = 'DELETE';
    protected const PATH = '/invites/{invite_code}';
    protected const REQUIRED = ['invite_code'];
}
