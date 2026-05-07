<?php

namespace OpenCompany\Integrations\Pushbullet\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Pushbullet\PushbulletService;

/**
 * Update a Pushbullet chat.
 *
 * Pushbullet currently documents muted state updates for chats.
 */
class PushbulletUpdateChat implements Tool
{
    /**
     * @param  PushbulletService  $service  The Pushbullet API client.
     */
    public function __construct(private PushbulletService $service) {}

    public function name(): string { return 'pushbullet_update_chat'; }

    public function description(): string { return 'Update a Pushbullet chat, usually to mute or unmute it.'; }

    public function parameters(): array
    {
        return [
            'chat_iden' => ['type' => 'string', 'required' => true, 'description' => 'Chat iden to update.'],
            'muted' => ['type' => 'boolean', 'required' => true, 'description' => 'Whether to mute the chat.'],
        ];
    }

    /**
     * Update a Pushbullet chat.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Pushbullet integration is not configured.');
            }

            return ToolResult::success($this->service->updateChat($args['chat_iden'] ?? '', ['muted' => (bool) ($args['muted'] ?? false)]));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
