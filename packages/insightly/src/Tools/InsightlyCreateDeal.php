<?php

namespace OpenCompany\Integrations\Insightly\Tools;

use OpenCompany\Integrations\Insightly\InsightlyService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool: Create Deal
 *
 * Creates a new deal (opportunity) in Insightly CRM.
 *
 * @see https://api.na1.insightly.com/v3.1/Help#!/Opportunities/PostEntity
 */
class InsightlyCreateDeal implements Tool
{
    /**
     * Create a new InsightlyCreateDeal tool instance.
     *
     * @param  InsightlyService  $service  The Insightly API service.
     */
    public function __construct(
        private InsightlyService $service,
    ) {}

    /**
     * Get the tool name identifier.
     */
    public function name(): string
    {
        return 'insightly_create_deal';
    }

    /**
     * Get the tool description for AI agents.
     */
    public function description(): string
    {
        return 'Create a new deal (opportunity) in Insightly CRM. Provide at minimum the opportunity name. Optionally set amount, stage, close date, and other fields.';
    }

    /**
     * Get the tool parameter definitions.
     *
     * @return array<string, array<string, mixed>> Parameter definitions keyed by name.
     */
    public function parameters(): array
    {
        return [
            'opportunity_name' => ['type' => 'string', 'required' => true, 'description' => 'Name of the deal/opportunity.'],
            'bid_amount' => ['type' => 'number', 'description' => 'Deal value/amount.'],
            'bid_currency' => ['type' => 'string', 'description' => 'Currency code (e.g., "USD", "EUR").'],
            'pipeline_id' => ['type' => 'integer', 'description' => 'ID of the pipeline to assign the deal to.'],
            'stage_id' => ['type' => 'integer', 'description' => 'ID of the pipeline stage.'],
            'close_date' => ['type' => 'string', 'description' => 'Expected close date (ISO 8601, e.g., "2026-06-30").'],
            'category_id' => ['type' => 'integer', 'description' => 'ID of the opportunity category.'],
            'background' => ['type' => 'string', 'description' => 'Background notes or description for the deal.'],
            'additional_fields' => ['type' => 'object', 'description' => 'Additional Insightly opportunity fields as key-value pairs.'],
        ];
    }

    /**
     * Execute the create deal tool.
     *
     * @param  array<string, mixed>  $args  Tool arguments with deal fields.
     * @return ToolResult The created deal record or an error message.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Insightly integration is not configured.');
            }

            if (!isset($args['opportunity_name'])) {
                return ToolResult::error('The "opportunity_name" parameter is required.');
            }

            $data = [
                'OPPORTUNITY_NAME' => $args['opportunity_name'],
            ];

            if (isset($args['bid_amount'])) {
                $data['BID_AMOUNT'] = (float) $args['bid_amount'];
            }
            if (isset($args['bid_currency'])) {
                $data['BID_CURRENCY'] = $args['bid_currency'];
            }
            if (isset($args['pipeline_id'])) {
                $data['PIPELINE_ID'] = (int) $args['pipeline_id'];
            }
            if (isset($args['stage_id'])) {
                $data['STAGE_ID'] = (int) $args['stage_id'];
            }
            if (isset($args['close_date'])) {
                $data['EXPECTED_CLOSE_DATE'] = $args['close_date'] . 'T00:00:00';
            }
            if (isset($args['category_id'])) {
                $data['OPPORTUNITY_CATEGORY_ID'] = (int) $args['category_id'];
            }
            if (isset($args['background'])) {
                $data['BACKGROUND'] = $args['background'];
            }

            if (isset($args['additional_fields']) && is_array($args['additional_fields'])) {
                $data = array_merge($data, $args['additional_fields']);
            }

            $result = $this->service->createDeal($data);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
