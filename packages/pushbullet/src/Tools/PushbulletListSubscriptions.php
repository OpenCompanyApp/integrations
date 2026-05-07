<?php

namespace OpenCompany\Integrations\Pushbullet\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Pushbullet\PushbulletService;

/**
 * List Pushbullet channel subscriptions.
 *
 * Supports pagination and sync parameters accepted by list-object endpoints.
 */
class PushbulletListSubscriptions implements Tool
{
    /**
     * @param  PushbulletService  $service  The Pushbullet API client.
     */
    public function __construct(private PushbulletService $service) {}

    public function name(): string { return 'pushbullet_list_subscriptions'; }

    public function description(): string { return 'List channel subscriptions belonging to the authenticated Pushbullet user.'; }

    public function parameters(): array
    {
        return [
            'limit' => ['type' => 'integer', 'description' => 'Maximum number of subscriptions to return.'],
            'cursor' => ['type' => 'string', 'description' => 'Pagination cursor.'],
            'active' => ['type' => 'boolean', 'description' => 'Set true to exclude deleted subscriptions.'],
            'modified_after' => ['type' => 'number', 'description' => 'Return subscriptions modified after this Unix timestamp.'],
        ];
    }

    /**
     * List Pushbullet subscriptions.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Pushbullet integration is not configured.');
            }

            return ToolResult::success($this->service->listSubscriptions($args));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
