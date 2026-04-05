<?php

namespace OpenCompany\Integrations\Chargebee\Tools;

use OpenCompany\Integrations\Chargebee\ChargebeeService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool to cancel a subscription in Chargebee.
 */
class ChargebeeCancelSubscription implements Tool
{
    /**
     * Create a new ChargebeeCancelSubscription tool instance.
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
        return 'chargebee_cancel_subscription';
    }

    /**
     * {@inheritdoc}
     */
    public function description(): string
    {
        return 'Cancel an active Chargebee subscription. The subscription will be cancelled immediately or at end of term depending on configuration.';
    }

    /**
     * {@inheritdoc}
     */
    public function parameters(): array
    {
        return [
            'id' => ['type' => 'string', 'required' => true, 'description' => 'The subscription ID to cancel.'],
            'end_of_term' => ['type' => 'boolean', 'description' => 'Cancel at end of the current billing term instead of immediately (default: false).'],
            'cancellation_reason' => ['type' => 'string', 'description' => 'Reason for cancellation (e.g., "customer_request", "payment_failure").'],
        ];
    }

    /**
     * Execute the cancel subscription request.
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

            $params = [];

            if (isset($args['end_of_term'])) {
                $params['end_of_term'] = $args['end_of_term'] ? 'true' : 'false';
            }
            if (!empty($args['cancellation_reason'])) {
                $params['cancellation_reason'] = $args['cancellation_reason'];
            }

            $result = $this->service->cancelSubscription($args['id']);

            $subscription = $result['subscription'] ?? $result;
            $customer = $result['customer'] ?? null;

            $response = ['subscription' => $subscription];
            if ($customer !== null) {
                $response['customer'] = $customer;
            }

            return ToolResult::success($response);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
