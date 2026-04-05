<?php

namespace OpenCompany\Integrations\Harvest\Tools;

use OpenCompany\Integrations\Harvest\HarvestService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Delete a Harvest time entry by ID.
 */
class HarvestDeleteTimeEntry implements Tool
{
    /**
     * @param  HarvestService  $service  The Harvest API client
     */
    public function __construct(
        private HarvestService $service,
    ) {}

    public function name(): string
    {
        return 'harvest_delete_time_entry';
    }

    public function description(): string
    {
        return 'Delete a Harvest time entry by its ID.';
    }

    public function parameters(): array
    {
        return [
            'id' => ['type' => 'integer', 'required' => true, 'description' => 'The time entry ID to delete.'],
        ];
    }

    /**
     * Delete a time entry by ID.
     *
     * @param  array<string, mixed>  $args  Tool arguments (id)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Harvest integration is not configured.');
            }

            $id = $args['id'] ?? null;

            if (empty($id)) {
                return ToolResult::error('id is required.');
            }

            $this->service->deleteTimeEntry((int) $id);

            return ToolResult::success([
                'deleted' => true,
                'id'      => (int) $id,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
