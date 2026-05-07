<?php

namespace OpenCompany\Integrations\Chargify\Tools;

use OpenCompany\Integrations\Chargify\ChargifyService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get a single customer by their Chargify ID.
 *
 * Returns full customer details including name, email, reference,
 * organization, and billing address.
 */
class ChargifyGetCustomer implements Tool
{
    /**
     * @param  ChargifyService  $service  The Chargify API client.
     */
    public function __construct(
        private ChargifyService $service,
    ) {}

    public function name(): string
    {
        return 'chargify_get_customer';
    }

    public function description(): string
    {
        return 'Get detailed information for a single Chargify customer by ID.';
    }

    public function parameters(): array
    {
        return [
            'customer_id' => ['type' => 'integer', 'required' => true, 'description' => 'The Chargify customer ID.'],
        ];
    }

    /**
     * Get a customer by ID through the Chargify API.
     *
     * @param  array<string, mixed>  $args  Tool arguments (customer_id).
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Chargify integration is not configured.');
            }

            if (!isset($args['customer_id'])) {
                return ToolResult::error('customer_id is required.');
            }

            $result = $this->service->getCustomer((int) $args['customer_id']);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
