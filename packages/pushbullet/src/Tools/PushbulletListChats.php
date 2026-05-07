<?php

namespace OpenCompany\Integrations\Pushbullet\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Pushbullet\PushbulletService;

/**
 * List Pushbullet chats.
 *
 * Supports pagination and sync parameters accepted by list-object endpoints.
 */
class PushbulletListChats implements Tool
{
    /**
     * @param  PushbulletService  $service  The Pushbullet API client.
     */
    public function __construct(private PushbulletService $service) {}

    public function name(): string { return 'pushbullet_list_chats'; }

    public function description(): string { return 'List chats belonging to the authenticated Pushbullet user.'; }

    public function parameters(): array
    {
        return [
            'limit' => ['type' => 'integer', 'description' => 'Maximum number of chats to return.'],
            'cursor' => ['type' => 'string', 'description' => 'Pagination cursor.'],
            'active' => ['type' => 'boolean', 'description' => 'Set true to exclude deleted chats.'],
            'modified_after' => ['type' => 'number', 'description' => 'Return chats modified after this Unix timestamp.'],
        ];
    }

    /**
     * List Pushbullet chats.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Pushbullet integration is not configured.');
            }

            return ToolResult::success($this->service->listChats($args));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
