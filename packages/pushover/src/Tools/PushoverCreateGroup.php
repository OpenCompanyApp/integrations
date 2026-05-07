<?php

namespace OpenCompany\Integrations\Pushover\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Pushover\PushoverService;

/**
 * Create a Pushover delivery group.
 */
class PushoverCreateGroup implements Tool
{
    /**
     * @param  PushoverService  $service  The Pushover API client.
     */
    public function __construct(
        private PushoverService $service,
    ) {}

    public function name(): string
    {
        return 'pushover_create_group';
    }

    public function description(): string
    {
        return 'Create a Pushover delivery group and return its group key.';
    }

    public function parameters(): array
    {
        return [
            'name' => ['type' => 'string', 'required' => true, 'description' => 'Human-readable group name.'],
        ];
    }

    /**
     * Create a delivery group.
     *
     * @param  array<string, mixed>  $args  Tool arguments (name).
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Pushover integration is not configured.');
            }

            $name = $args['name'] ?? '';
            if ($name === '') {
                return ToolResult::error('name is required.');
            }

            return ToolResult::success($this->service->createGroup($name));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
