<?php

namespace OpenCompany\Integrations\Pushbullet\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Pushbullet\PushbulletService;

/**
 * Delete a Pushbullet chat.
 *
 * Removes a chat object from the authenticated account.
 */
class PushbulletDeleteChat implements Tool
{
    /**
     * @param  PushbulletService  $service  The Pushbullet API client.
     */
    public function __construct(private PushbulletService $service) {}

    public function name(): string { return 'pushbullet_delete_chat'; }

    public function description(): string { return 'Delete a Pushbullet chat by chat iden.'; }

    public function parameters(): array
    {
        return [
            'chat_iden' => ['type' => 'string', 'required' => true, 'description' => 'Chat iden to delete.'],
        ];
    }

    /**
     * Delete a Pushbullet chat.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Pushbullet integration is not configured.');
            }

            $this->service->deleteChat($args['chat_iden'] ?? '');

            return ToolResult::success(['deleted' => true, 'chat_iden' => $args['chat_iden'] ?? '']);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
