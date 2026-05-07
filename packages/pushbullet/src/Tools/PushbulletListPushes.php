<?php

namespace OpenCompany\Integrations\Pushbullet\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Pushbullet\PushbulletService;

/**
 * List pushes for the authenticated Pushbullet account.
 *
 * Supports Pushbullet pagination and sync parameters.
 */
class PushbulletListPushes implements Tool
{
    /**
     * @param  PushbulletService  $service  The Pushbullet API client.
     */
    public function __construct(
        private PushbulletService $service,
    ) {}

    public function name(): string
    {
        return 'pushbullet_list_pushes';
    }

    public function description(): string
    {
        return 'List recent pushes (notifications) from Pushbullet. Returns push items including notes, links, and files.';
    }

    public function parameters(): array
    {
        return [
            'limit' => ['type' => 'integer', 'description' => 'Maximum number of pushes to return (default: 10, max: 500).'],
            'cursor' => ['type' => 'string', 'description' => 'Pagination cursor from a previous response to get the next page of results.'],
            'active' => ['type' => 'boolean', 'description' => 'Set true to exclude deleted pushes.'],
            'modified_after' => ['type' => 'number', 'description' => 'Return pushes modified after this Unix timestamp.'],
        ];
    }

    /**
     * List pushes using optional pagination and sync filters.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Pushbullet integration is not configured.');
            }

            $params = [];
            foreach (['limit', 'cursor', 'active', 'modified_after'] as $field) {
                if (array_key_exists($field, $args)) {
                    $params[$field] = $args[$field];
                }
            }

            $result = $this->service->listPushes($params);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
