<?php

namespace OpenCompany\Integrations\Chargebee\Tools;

use OpenCompany\Integrations\Chargebee\ChargebeeService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool to retrieve a single customer from Chargebee by ID.
 */
class ChargebeeGetCustomer implements Tool
{
    /**
     * Create a new ChargebeeGetCustomer tool instance.
     *
     * @param  ChargebeeService  $service  The Chargebee API service.
     */
    public function __construct(
        private ChargebeeService $service,
    ) {}

    /**
     * {@inheritdoc}
     */
    public function name(): string
    {
        return 'chargebee_get_customer';
    }

    /**
     * {@inheritdoc}
     */
    public function description(): string
    {
        return 'Retrieve detailed information about a specific Chargebee customer by their ID, including contact details, billing address, and payment method.';
    }

    /**
     * {@inheritdoc}
     */
    public function parameters(): array
    {
        return [
            'id' => ['type' => 'string', 'required' => true, 'description' => 'The customer ID.'],
        ];
    }

    /**
     * Execute the get customer request.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Chargebee integration is not configured.');
            }

            if (empty($args['id'])) {
                return ToolResult::error('Customer ID is required.');
            }

            $result = $this->service->getCustomer($args['id']);

            $customer = $result['customer'] ?? $result;
            $card = $result['card'] ?? null;

            $response = ['customer' => $customer];
            if ($card !== null) {
                $response['card'] = $card;
            }

            return ToolResult::success($response);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
