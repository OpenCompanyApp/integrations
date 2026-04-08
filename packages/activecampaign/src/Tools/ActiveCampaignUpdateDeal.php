<?php

namespace OpenCompany\Integrations\ActiveCampaign\Tools;

use OpenCompany\Integrations\ActiveCampaign\ActiveCampaignService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool to update an existing deal in ActiveCampaign.
 */
class ActiveCampaignUpdateDeal implements Tool
{
    /**
     * @param ActiveCampaignService $service The ActiveCampaign service instance.
     */
    public function __construct(
        private ActiveCampaignService $service,
    ) {}

    /**
     * Get the tool name.
     *
     * @return string The tool identifier.
     */
    public function name(): string
    {
        return 'activecampaign_update_deal';
    }

    /**
     * Get the tool description.
     *
     * @return string A human-readable description of what the tool does.
     */
    public function description(): string
    {
        return 'Update an existing deal in ActiveCampaign. Provide the deal ID and any fields to update (title, value, stage, pipeline, status, etc.).';
    }

    /**
     * Get the tool parameter definitions.
     *
     * @return array<string, array{type: string, description?: string, required?: bool}> The parameter definitions.
     */
    public function parameters(): array
    {
        return [
            'deal_id' => ['type' => 'integer', 'required' => true, 'description' => 'The ActiveCampaign deal ID to update.'],
            'title' => ['type' => 'string', 'description' => 'Updated deal title.'],
            'value' => ['type' => 'number', 'description' => 'Updated deal value.'],
            'stage' => ['type' => 'integer', 'description' => 'Updated pipeline stage ID.'],
            'pipeline' => ['type' => 'integer', 'description' => 'Updated pipeline ID.'],
            'status' => ['type' => 'integer', 'description' => 'Deal status: 0=open, 1=won, 2=lost, 3=abandoned.'],
            'owner' => ['type' => 'string', 'description' => 'Updated deal owner (user ID).'],
            'percent' => ['type' => 'integer', 'description' => 'Updated deal percentage (custom field).'],
            'fields' => ['type' => 'object', 'description' => 'Additional custom fields as key-value pairs.'],
        ];
    }

    /**
     * Execute the tool: update a deal in ActiveCampaign.
     *
     * @param  array     $args The tool arguments (deal_id and optional fields to update).
     * @return ToolResult      The result containing the updated deal or an error message.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('ActiveCampaign integration is not configured.');
            }

            $dealId = (int) ($args['deal_id'] ?? 0);
            if ($dealId <= 0) {
                return ToolResult::error('A valid deal_id is required.');
            }

            $data = [];
            foreach (['title', 'value', 'stage', 'pipeline', 'status', 'owner', 'percent'] as $field) {
                if (array_key_exists($field, $args)) {
                    $data[$field] = $args[$field];
                }
            }

            if (isset($args['fields']) && is_array($args['fields'])) {
                $data = array_merge($data, $args['fields']);
            }

            if (empty($data)) {
                return ToolResult::error('At least one field must be provided to update.');
            }

            $result = $this->service->updateDeal($dealId, $data);
            $deal = $result['deal'] ?? $result;

            $statusMap = [0 => 'open', 1 => 'won', 2 => 'lost', 3 => 'abandoned'];

            return ToolResult::success([
                'id' => (int) ($deal['id'] ?? $dealId),
                'title' => $deal['title'] ?? '',
                'value' => isset($deal['value']) ? (float) $deal['value'] : 0,
                'status' => $statusMap[(int) ($deal['status'] ?? 0)] ?? $deal['status'] ?? '',
                'stage' => $deal['stage'] ?? '',
                'pipeline' => $deal['pipeline'] ?? '',
                'updated' => $deal['udate'] ?? null,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
