<?php

namespace OpenCompany\Integrations\Pushover\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Pushover\PushoverService;

/**
 * Add a Pushover user or device to a delivery group.
 */
class PushoverAddGroupUser implements Tool
{
    /**
     * @param  PushoverService  $service  The Pushover API client.
     */
    public function __construct(
        private PushoverService $service,
    ) {}

    public function name(): string
    {
        return 'pushover_add_group_user';
    }

    public function description(): string
    {
        return 'Add a user key, optionally scoped to a device, to a Pushover delivery group.';
    }

    public function parameters(): array
    {
        return [
            'group_key' => ['type' => 'string', 'required' => true, 'description' => 'Pushover delivery group key.'],
            'user_key' => ['type' => 'string', 'required' => true, 'description' => 'Pushover user key to add.'],
            'device' => ['type' => 'string', 'description' => 'Optional device name for this group member.'],
            'memo' => ['type' => 'string', 'description' => 'Optional memo to store with the member.'],
        ];
    }

    /**
     * Add a user to a delivery group.
     *
     * @param  array<string, mixed>  $args  Tool arguments (group_key, user_key, device, memo).
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

            $data = [];
            foreach (['device', 'memo'] as $key) {
                if (! empty($args[$key])) {
                    $data[$key] = $args[$key];
                }
            }

            return ToolResult::success($this->service->addGroupUser($groupKey, $userKey, $data));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
