<?php

namespace OpenCompany\Integrations\Pushover\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Pushover\PushoverService;

/**
 * Re-enable a disabled Pushover delivery group member.
 */
class PushoverEnableGroupUser implements Tool
{
    /**
     * @param  PushoverService  $service  The Pushover API client.
     */
    public function __construct(
        private PushoverService $service,
    ) {}

    public function name(): string
    {
        return 'pushover_enable_group_user';
    }

    public function description(): string
    {
        return 'Re-enable a disabled user key, optionally scoped to a device, in a Pushover delivery group.';
    }

    public function parameters(): array
    {
        return [
            'group_key' => ['type' => 'string', 'required' => true, 'description' => 'Pushover delivery group key.'],
            'user_key' => ['type' => 'string', 'required' => true, 'description' => 'Pushover user key to enable.'],
            'device' => ['type' => 'string', 'description' => 'Optional device name to match.'],
        ];
    }

    /**
     * Enable a group user.
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

            return ToolResult::success($this->service->enableGroupUser($groupKey, $userKey, $args['device'] ?? null));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
