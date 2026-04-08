<?php

namespace OpenCompany\Integrations\Pipedrive\Tools;

use OpenCompany\Integrations\Pipedrive\PipedriveService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Update an existing deal in Pipedrive CRM.
 *
 * Supports updating title, value, stage, and status fields.
 */
class PipedriveUpdateDeal implements Tool
{
    /**
     * @param  PipedriveService  $service  The Pipedrive API client
     */
    public function __construct(
        private PipedriveService $service,
    ) {}

    public function name(): string
    {
        return 'pipedrive_update_deal';
    }

    public function description(): string
    {
        return 'Update an existing deal in Pipedrive CRM. Provide the deal ID and at least one field to update (title, value, stage_id, status).';
    }

    public function parameters(): array
    {
        return [
            'id'       => ['type' => 'integer', 'required' => true, 'description' => 'The Pipedrive deal ID.'],
            'title'    => ['type' => 'string', 'description' => 'Updated title of the deal.'],
            'value'    => ['type' => 'number', 'description' => 'Updated value of the deal.'],
            'stage_id' => ['type' => 'integer', 'description' => 'ID of the new stage.'],
            'status'   => ['type' => 'string', 'description' => 'Deal status: "open", "won", or "lost".'],
        ];
    }

    /**
     * Update a Pipedrive deal with the provided fields.
     *
     * @param  array<string, mixed>  $args  Tool arguments (id, title, value, stage_id, status)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Pipedrive integration is not configured.');
            }

            $id = $args['id'] ?? '';
            if (empty($id)) {
                return ToolResult::error('id is required.');
            }

            $data = [];

            if (array_key_exists('title', $args)) {
                $data['title'] = $args['title'];
            }
            if (array_key_exists('value', $args)) {
                $data['value'] = $args['value'];
            }
            if (! empty($args['stage_id'])) {
                $data['stage_id'] = (int) $args['stage_id'];
            }
            if (! empty($args['status'])) {
                $data['status'] = $args['status'];
            }

            if (empty($data)) {
                return ToolResult::error('At least one field to update is required (title, value, stage_id, status).');
            }

            $result = $this->service->updateDeal($id, $data);
            $deal = $result['data'] ?? $result;

            return ToolResult::success($deal);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
