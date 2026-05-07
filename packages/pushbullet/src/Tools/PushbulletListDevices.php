<?php

namespace OpenCompany\Integrations\Pushbullet\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Pushbullet\PushbulletService;

/**
 * List devices for the authenticated Pushbullet account.
 *
 * Supports Pushbullet pagination and sync parameters.
 */
class PushbulletListDevices implements Tool
{
    /**
     * @param  PushbulletService  $service  The Pushbullet API client.
     */
    public function __construct(
        private PushbulletService $service,
    ) {}

    public function name(): string
    {
        return 'pushbullet_list_devices';
    }

    public function description(): string
    {
        return 'List all devices registered with the current user\'s Pushbullet account. Returns device names, types, and identifiers.';
    }

    public function parameters(): array
    {
        return [
            'limit' => ['type' => 'integer', 'description' => 'Maximum number of devices to return.'],
            'cursor' => ['type' => 'string', 'description' => 'Pagination cursor from a previous response.'],
            'active' => ['type' => 'boolean', 'description' => 'Set true to exclude deleted devices.'],
            'modified_after' => ['type' => 'number', 'description' => 'Return devices modified after this Unix timestamp.'],
        ];
    }

    /**
     * List devices using optional pagination and sync filters.
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

            $result = $this->service->listDevices($params);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
