<?php

namespace OpenCompany\Integrations\Harvest\Tools;

use OpenCompany\Integrations\Harvest\HarvestService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Update an existing Harvest time entry.
 *
 * Supports updating hours, notes, and spent_date.
 */
class HarvestUpdateTimeEntry implements Tool
{
    /**
     * @param  HarvestService  $service  The Harvest API client
     */
    public function __construct(
        private HarvestService $service,
    ) {}

    public function name(): string
    {
        return 'harvest_update_time_entry';
    }

    public function description(): string
    {
        return 'Update an existing Harvest time entry (hours, notes, or spent_date).';
    }

    public function parameters(): array
    {
        return [
            'id'         => ['type' => 'integer', 'required' => true, 'description' => 'The time entry ID to update.'],
            'hours'      => ['type' => 'number',  'description' => 'Updated number of hours (e.g. 2.5).'],
            'notes'      => ['type' => 'string',  'description' => 'Updated notes for the time entry.'],
            'spent_date' => ['type' => 'string',  'description' => 'Updated spent date (YYYY-MM-DD).'],
        ];
    }

    /**
     * Update a time entry with new values.
     *
     * @param  array<string, mixed>  $args  Tool arguments (id, hours, notes, spent_date)
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

            $data = [];

            if (isset($args['hours'])) {
                $data['hours'] = (float) $args['hours'];
            }
            if (isset($args['notes'])) {
                $data['notes'] = $args['notes'];
            }
            if (isset($args['spent_date'])) {
                $data['spent_date'] = $args['spent_date'];
            }

            if (empty($data)) {
                return ToolResult::error('At least one of hours, notes, or spent_date must be provided.');
            }

            $result = $this->service->updateTimeEntry((int) $id, $data);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
