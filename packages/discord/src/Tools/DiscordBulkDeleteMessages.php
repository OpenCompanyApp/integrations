<?php

namespace OpenCompany\Integrations\Discord\Tools;

/**
 * Bulk delete Discord messages.
 *
 * Deletes multiple messages from a guild channel using Discord's bulk endpoint.
 */
class DiscordBulkDeleteMessages extends AbstractDiscordTool
{
    protected const NAME = 'discord_bulk_delete_messages';
    protected const DESCRIPTION = 'Bulk delete Discord messages from a channel. Requires Manage Messages permission.';
    protected const PARAMETERS = [
        'channel_id' => ['type' => 'string', 'required' => true, 'description' => 'Channel ID.'],
        'messages' => ['type' => 'array', 'required' => true, 'description' => 'Message IDs to delete.'],
    ];
    protected const METHOD = 'POST';
    protected const PATH = '/channels/{channel_id}/messages/bulk-delete';
    protected const REQUIRED = ['channel_id', 'messages'];
    protected const BODY_KEYS = ['messages'];
    protected const BODY_REQUIRED = true;
}
