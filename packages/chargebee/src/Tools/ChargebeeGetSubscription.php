<?php

namespace OpenCompany\Integrations\Chargebee\Tools;

use OpenCompany\Integrations\Chargebee\ChargebeeService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool to retrieve a single subscription from Chargebee by ID.
 *
 * Returns detailed subscription information including plan, billing cycle,
 * status, trial period, and associated customer.
 */
class ChargebeeGetSubscription implements Tool
{
    /**
     * Create a new ChargebeeGetSubscription tool instance.
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
        return 'chargebee_get_subscription';
    }

    /**
     * {@inheritdoc}
     */
    public function description(): string
    {
        return 'Retrieve detailed information about a specific Chargebee subscription by its ID, including plan details, billing period, status, and associated customer.';
    }

    /**
     * {@inheritdoc}
     */
    public function parameters(): array
    {
        return [
            'id' => ['type' => 'string', 'required' => true, 'description' => 'The subscription ID.'],
        ];
    }

    /**
     * Execute the get subscription request.
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
                return ToolResult::error('Subscription ID is required.');
            }

            $result = $this->service->getSubscription($args['id']);

            $subscription = $result['subscription'] ?? $result;
            $customer = $result['customer'] ?? null;
            $card = $result['card'] ?? null;

            $response = ['subscription' => $subscription];

            if ($customer !== null) {
                $response['customer'] = $customer;
            }
            if ($card !== null) {
                $response['card'] = $card;
            }

            return ToolResult::success($response);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
