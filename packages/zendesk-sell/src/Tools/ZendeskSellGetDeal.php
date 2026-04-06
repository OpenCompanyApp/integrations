<?php

namespace OpenCompany\Integrations\ZendeskSell\Tools;

use OpenCompany\Integrations\ZendeskSell\ZendeskSellService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get a single deal by ID from Zendesk Sell.
 *
 * Retrieves full details for a specific deal including value, status,
 * associated contact, organization, stage, and custom fields.
 */
class ZendeskSellGetDeal implements Tool
{
    public function __construct(
        private ZendeskSellService $service,
    ) {}

    public function name(): string
    {
        return 'zendesk_sell_get_deal';
    }

    public function description(): string
    {
        return 'Get full details of a specific deal in Zendesk Sell by its ID. Returns deal value, status, associated contact and organization, pipeline stage, and custom fields.';
    }

    public function parameters(): array
    {
        return [
            'id' => ['type' => 'integer', 'required' => true, 'description' => 'The deal ID.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Zendesk Sell integration is not configured.');
            }

            if (empty($args['id'])) {
                return ToolResult::error('Deal ID is required.');
            }

            $result = $this->service->getDeal((int) $args['id']);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
