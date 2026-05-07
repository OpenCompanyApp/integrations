<?php

namespace OpenCompany\Integrations\Pushover\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Pushover\PushoverService;

/**
 * Retrieve a Pushover delivery group's metadata and member list.
 */
class PushoverGetGroup implements Tool
{
    /**
     * @param  PushoverService  $service  The Pushover API client.
     */
    public function __construct(
        private PushoverService $service,
    ) {}

    public function name(): string
    {
        return 'pushover_get_group';
    }

    public function description(): string
    {
        return 'Get a Pushover delivery group name and member list by group key.';
    }

    public function parameters(): array
    {
        return [
            'group_key' => ['type' => 'string', 'required' => true, 'description' => 'Pushover delivery group key.'],
        ];
    }

    /**
     * Get one delivery group.
     *
     * @param  array<string, mixed>  $args  Tool arguments (group_key).
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Pushover integration is not configured.');
            }

            $groupKey = $args['group_key'] ?? '';
            if ($groupKey === '') {
                return ToolResult::error('group_key is required.');
            }

            return ToolResult::success($this->service->getGroup($groupKey));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
