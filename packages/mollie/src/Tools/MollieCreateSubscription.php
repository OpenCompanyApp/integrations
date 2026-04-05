<?php

namespace OpenCompany\Integrations\Mollie\Tools;

use OpenCompany\Integrations\Mollie\MollieService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Create a subscription for a Mollie customer.
 *
 * Requires a customer ID, amount, interval, and description.
 * Returns the created subscription resource.
 */
class MollieCreateSubscription implements Tool
{
    /**
     * Create a new MollieCreateSubscription tool instance.
     */
    public function __construct(
        private MollieService $service,
    ) {}

    /**
     * Get the tool name identifier.
     */
    public function name(): string
    {
        return 'mollie_create_subscription';
    }

    /**
     * Get the tool description for AI agents.
     */
    public function description(): string
    {
        return 'Create a subscription for a Mollie customer. Requires customer ID, amount (currency and value), interval (e.g., "1 month"), and description.';
    }

    /**
     * Get the tool parameter definitions.
     *
     * @return array<string, array{type: string, required?: bool, description: string}>
     */
    public function parameters(): array
    {
        return [
            'customer_id' => ['type' => 'string', 'required' => true, 'description' => 'The customer ID (e.g., "cst_abc123").'],
            'amount' => ['type' => 'object', 'required' => true, 'description' => 'Amount object with "currency" (e.g., "EUR") and "value" (e.g., "9.99").'],
            'interval' => ['type' => 'string', 'required' => true, 'description' => 'Billing interval (e.g., "1 month", "1 year", "2 weeks").'],
            'description' => ['type' => 'string', 'required' => true, 'description' => 'Description of the subscription shown to the customer.'],
            'method' => ['type' => 'string', 'description' => 'Payment method (e.g., "ideal", "creditcard").'],
            'webhookUrl' => ['type' => 'string', 'description' => 'URL to receive webhook notifications for subscription events.'],
            'metadata' => ['type' => 'object', 'description' => 'Custom metadata to attach to the subscription.'],
            'startDate' => ['type' => 'string', 'description' => 'Start date for the subscription (ISO 8601, e.g., "2026-05-01").'],
            'times' => ['type' => 'integer', 'description' => 'Number of billing cycles. Omit for indefinite.'],
        ];
    }

    /**
     * Execute the create subscription tool.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Mollie integration is not configured.');
            }

            if (empty($args['customer_id'])) {
                return ToolResult::error('Customer ID is required.');
            }

            if (empty($args['amount'])) {
                return ToolResult::error('Amount is required. Provide an object with "currency" and "value".');
            }

            if (empty($args['interval'])) {
                return ToolResult::error('Interval is required (e.g., "1 month", "1 year").');
            }

            if (empty($args['description'])) {
                return ToolResult::error('Description is required.');
            }

            $data = [
                'amount' => $args['amount'],
                'interval' => $args['interval'],
                'description' => $args['description'],
            ];

            if (isset($args['method'])) {
                $data['method'] = $args['method'];
            }
            if (isset($args['webhookUrl'])) {
                $data['webhookUrl'] = $args['webhookUrl'];
            }
            if (isset($args['metadata'])) {
                $data['metadata'] = $args['metadata'];
            }
            if (isset($args['startDate'])) {
                $data['startDate'] = $args['startDate'];
            }
            if (isset($args['times'])) {
                $data['times'] = (int) $args['times'];
            }

            $result = $this->service->createSubscription($args['customer_id'], $data);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
