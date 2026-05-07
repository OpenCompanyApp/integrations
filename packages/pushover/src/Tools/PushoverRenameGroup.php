<?php

namespace OpenCompany\Integrations\Pushover\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Pushover\PushoverService;

/**
 * Rename a Pushover delivery group.
 */
class PushoverRenameGroup implements Tool
{
    /**
     * @param  PushoverService  $service  The Pushover API client.
     */
    public function __construct(
        private PushoverService $service,
    ) {}

    public function name(): string
    {
        return 'pushover_rename_group';
    }

    public function description(): string
    {
        return 'Rename a Pushover delivery group by group key.';
    }

    public function parameters(): array
    {
        return [
            'group_key' => ['type' => 'string', 'required' => true, 'description' => 'Pushover delivery group key.'],
            'name' => ['type' => 'string', 'required' => true, 'description' => 'New group name.'],
        ];
    }

    /**
     * Rename a delivery group.
     *
     * @param  array<string, mixed>  $args  Tool arguments (group_key, name).
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Pushover integration is not configured.');
            }

            $groupKey = $args['group_key'] ?? '';
            $name = $args['name'] ?? '';
            if ($groupKey === '' || $name === '') {
                return ToolResult::error('group_key and name are required.');
            }

            return ToolResult::success($this->service->renameGroup($groupKey, $name));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
