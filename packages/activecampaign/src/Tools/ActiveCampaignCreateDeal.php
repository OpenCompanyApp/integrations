<?php

namespace OpenCompany\Integrations\ActiveCampaign\Tools;

use OpenCompany\Integrations\ActiveCampaign\ActiveCampaignService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool to create a new deal in ActiveCampaign.
 */
class ActiveCampaignCreateDeal implements Tool
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
        return 'activecampaign_create_deal';
    }

    /**
     * Get the tool description.
     *
     * @return string A human-readable description of what the tool does.
     */
    public function description(): string
    {
        return 'Create a new deal in ActiveCampaign. Requires a title, value, contact ID, and stage. Optionally specify a pipeline.';
    }

    /**
     * Get the tool parameter definitions.
     *
     * @return array<string, array{type: string, description?: string, required?: bool}> The parameter definitions.
     */
    public function parameters(): array
    {
        return [
            'title' => ['type' => 'string', 'required' => true, 'description' => 'The deal title.'],
            'value' => ['type' => 'number', 'required' => true, 'description' => 'The deal value (e.g., 5000 for $5,000).'],
            'contact_id' => ['type' => 'integer', 'required' => true, 'description' => 'The associated contact ID.'],
            'stage' => ['type' => 'integer', 'required' => true, 'description' => 'The pipeline stage ID to place the deal in.'],
            'pipeline' => ['type' => 'integer', 'description' => 'The pipeline ID. If omitted, the default pipeline is used.'],
        ];
    }

    /**
     * Execute the tool: create a deal in ActiveCampaign.
     *
     * @param  array     $args The tool arguments (title, value, contact_id, stage, pipeline).
     * @return ToolResult      The result containing the created deal or an error message.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('ActiveCampaign integration is not configured.');
            }

            $title = $args['title'] ?? '';
            $value = (float) ($args['value'] ?? 0);
            $contactId = (int) ($args['contact_id'] ?? 0);
            $stage = (int) ($args['stage'] ?? 0);

            if (empty($title)) {
                return ToolResult::error('A deal title is required.');
            }
            if ($contactId <= 0) {
                return ToolResult::error('A valid contact_id is required.');
            }
            if ($stage <= 0) {
                return ToolResult::error('A valid stage ID is required.');
            }

            $result = $this->service->createDeal(
                title: $title,
                value: $value,
                contactId: $contactId,
                stage: $stage,
                pipeline: isset($args['pipeline']) ? (int) $args['pipeline'] : null,
            );

            $deal = $result['deal'] ?? $result;

            return ToolResult::success([
                'id' => (int) ($deal['id'] ?? 0),
                'title' => $deal['title'] ?? $title,
                'value' => isset($deal['value']) ? (float) $deal['value'] : $value,
                'contact_id' => (int) ($deal['contact'] ?? $contactId),
                'stage' => $deal['stage'] ?? $stage,
                'pipeline' => $deal['pipeline'] ?? ($args['pipeline'] ?? null),
                'created' => $deal['cdate'] ?? null,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
