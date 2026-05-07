<?php

namespace OpenCompany\Integrations\Pushover\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Pushover\PushoverService;

/**
 * Remove a Pushover user or device from a delivery group.
 */
class PushoverRemoveGroupUser implements Tool
{
    /**
     * @param  PushoverService  $service  The Pushover API client.
     */
    public function __construct(
        private PushoverService $service,
    ) {}

    public function name(): string
    {
        return 'pushover_remove_group_user';
    }

    public function description(): string
    {
        return 'Remove a user key, optionally scoped to a device, from a Pushover delivery group.';
    }

    public function parameters(): array
    {
        return [
            'group_key' => ['type' => 'string', 'required' => true, 'description' => 'Pushover delivery group key.'],
            'user_key' => ['type' => 'string', 'required' => true, 'description' => 'Pushover user key to remove.'],
            'device' => ['type' => 'string', 'description' => 'Optional device name to match.'],
        ];
    }

    /**
     * Remove a user from a delivery group.
     *
     * @param  array<string, mixed>  $args  Tool arguments (group_key, user_key, device).
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Pushover integration is not configured.');
            }

            $groupKey = $args['group_key'] ?? '';
            $userKey = $args['user_key'] ?? '';
            if ($groupKey === '' || $userKey === '') {
                return ToolResult::error('group_key and user_key are required.');
            }

            return ToolResult::success($this->service->removeGroupUser($groupKey, $userKey, $args['device'] ?? null));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
