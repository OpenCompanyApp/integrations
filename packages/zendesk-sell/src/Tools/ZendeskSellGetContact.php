<?php

namespace OpenCompany\Integrations\ZendeskSell\Tools;

use OpenCompany\Integrations\ZendeskSell\ZendeskSellService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get a single contact by ID from Zendesk Sell.
 *
 * Retrieves full details for a specific contact including name, email,
 * phone, organization, custom fields, and associated metadata.
 */
class ZendeskSellGetContact implements Tool
{
    public function __construct(
        private ZendeskSellService $service,
    ) {}

    public function name(): string
    {
        return 'zendesk_sell_get_contact';
    }

    public function description(): string
    {
        return 'Get full details of a specific contact in Zendesk Sell by its ID. Returns all contact fields including email, phone, organization, and custom fields.';
    }

    public function parameters(): array
    {
        return [
            'id' => ['type' => 'integer', 'required' => true, 'description' => 'The contact ID.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Zendesk Sell integration is not configured.');
            }

            if (empty($args['id'])) {
                return ToolResult::error('Contact ID is required.');
            }

            $result = $this->service->getContact((int) $args['id']);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
