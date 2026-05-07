<?php

namespace OpenCompany\Integrations\Pushbullet\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Pushbullet\PushbulletService;

/**
 * Create a Pushbullet chat.
 *
 * The email address can belong to a Pushbullet user or an external recipient.
 */
class PushbulletCreateChat implements Tool
{
    /**
     * @param  PushbulletService  $service  The Pushbullet API client.
     */
    public function __construct(private PushbulletService $service) {}

    public function name(): string { return 'pushbullet_create_chat'; }

    public function description(): string { return 'Create a Pushbullet chat with another user or email address.'; }

    public function parameters(): array
    {
        return [
            'email' => ['type' => 'string', 'required' => true, 'description' => 'Email address to create a chat with.'],
        ];
    }

    /**
     * Create a Pushbullet chat.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Pushbullet integration is not configured.');
            }

            return ToolResult::success($this->service->createChat($args['email'] ?? ''));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
