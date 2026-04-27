<?php

namespace OpenCompany\Integrations\Gravity\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Gravity\GravityService;

/**
 * Get a specific Gravity entry by ID.
 */
class GravityGetEntry implements Tool
{
    /**
     * @param  GravityService  $service  The Gravity API client.
     */
    public function __construct(
        private GravityService $service,
    ) {}

    public function name(): string
    {
        return 'gravity_get_entry';
    }

    public function description(): string
    {
        return 'Get details for a specific Gravity entry.';
    }

    public function parameters(): array
    {
        return [
            'entry_id' => ['type' => 'string', 'required' => true, 'description' => 'The entry ID.'],
        ];
    }

    /**
     * Get entry details.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Gravity integration is not configured.');
            }
            if (empty($args['entry_id'])) {
                return ToolResult::error('Entry ID is required.');
            }

            return ToolResult::success($this->service->getEntry((string) $args['entry_id']));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
