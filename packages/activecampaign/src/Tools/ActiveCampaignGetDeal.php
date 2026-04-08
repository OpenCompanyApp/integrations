<?php

namespace OpenCompany\Integrations\ActiveCampaign\Tools;

use OpenCompany\Integrations\ActiveCampaign\ActiveCampaignService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool to get a single deal by ID from ActiveCampaign.
 */
class ActiveCampaignGetDeal implements Tool
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
        return 'activecampaign_get_deal';
    }

    /**
     * Get the tool description.
     *
     * @return string A human-readable description of what the tool does.
     */
    public function description(): string
    {
        return 'Get details of a specific ActiveCampaign deal by ID, including title, value, stage, pipeline, and associated contact.';
    }

    /**
     * Get the tool parameter definitions.
     *
     * @return array<string, array{type: string, description?: string, required?: bool}> The parameter definitions.
     */
    public function parameters(): array
    {
        return [
            'deal_id' => ['type' => 'integer', 'required' => true, 'description' => 'The ActiveCampaign deal ID.'],
        ];
    }

    /**
     * Execute the tool: get a deal from ActiveCampaign.
     *
     * @param  array     $args The tool arguments (deal_id).
     * @return ToolResult      The result containing the deal or an error message.
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

            $result = $this->service->getDeal($dealId);
            $deal = $result['deal'] ?? $result;

            $statusMap = [0 => 'open', 1 => 'won', 2 => 'lost', 3 => 'abandoned'];

            return ToolResult::success([
                'id' => (int) ($deal['id'] ?? 0),
                'title' => $deal['title'] ?? '',
                'value' => isset($deal['value']) ? (float) $deal['value'] : 0,
                'currency' => $deal['currency'] ?? '',
                'status' => $statusMap[(int) ($deal['status'] ?? 0)] ?? $deal['status'] ?? '',
                'contact_id' => (int) ($deal['contact'] ?? 0),
                'stage' => $deal['stage'] ?? '',
                'pipeline' => $deal['pipeline'] ?? '',
                'owner' => $deal['owner'] ?? '',
                'created' => $deal['cdate'] ?? null,
                'updated' => $deal['udate'] ?? null,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
