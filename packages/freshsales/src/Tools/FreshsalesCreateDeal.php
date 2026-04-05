<?php

namespace OpenCompany\Integrations\Freshsales\Tools;

use OpenCompany\Integrations\Freshsales\FreshsalesService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class FreshsalesCreateDeal implements Tool
{
    /**
     * Create a new FreshsalesCreateDeal tool instance.
     */
    public function __construct(
        private FreshsalesService $service,
    ) {}

    /**
     * Get the tool name.
     */
    public function name(): string
    {
        return 'freshsales_create_deal';
    }

    /**
     * Get the tool description.
     */
    public function description(): string
    {
        return 'Create a new deal in Freshsales CRM. Requires a name. Optionally set amount, stage, and close date.';
    }

    /**
     * Get the tool parameter definitions.
     *
     * @return array<string, array<string, mixed>>
     */
    public function parameters(): array
    {
        return [
            'name' => ['type' => 'string', 'required' => true, 'description' => 'Deal name.'],
            'amount' => ['type' => 'number', 'description' => 'Deal amount (numeric value).'],
            'deal_stage_id' => ['type' => 'integer', 'description' => 'ID of the deal stage (pipeline stage).'],
            'sales_account_id' => ['type' => 'integer', 'description' => 'ID of the associated sales account.'],
            'contact_ids' => ['type' => 'array', 'description' => 'Array of contact IDs to associate with the deal.'],
            'expected_close' => ['type' => 'string', 'description' => 'Expected close date (ISO 8601, e.g., "2026-06-30").'],
            'probability' => ['type' => 'integer', 'description' => 'Win probability percentage (0-100).'],
            'notes' => ['type' => 'string', 'description' => 'Notes or description for the deal.'],
        ];
    }

    /**
     * Execute the tool with the given arguments.
     *
     * @param  array<string, mixed>  $args
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Freshsales integration is not configured.');
            }

            if (empty($args['name'])) {
                return ToolResult::error('A deal name is required.');
            }

            $data = array_filter([
                'name' => $args['name'],
                'amount' => $args['amount'] ?? null,
                'deal_stage_id' => $args['deal_stage_id'] ?? null,
                'sales_account_id' => $args['sales_account_id'] ?? null,
                'contact_ids' => $args['contact_ids'] ?? null,
                'expected_close' => $args['expected_close'] ?? null,
                'probability' => $args['probability'] ?? null,
                'notes' => $args['notes'] ?? null,
            ], fn ($value) => $value !== null);

            $result = $this->service->createDeal($data);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
