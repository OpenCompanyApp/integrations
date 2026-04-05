<?php

namespace OpenCompany\Integrations\Chargebee\Tools;

use OpenCompany\Integrations\Chargebee\ChargebeeService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool to create a new subscription in Chargebee.
 *
 * Creates a subscription for an existing or new customer with a specified plan.
 */
class ChargebeeCreateSubscription implements Tool
{
    /**
     * Create a new ChargebeeCreateSubscription tool instance.
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
        return 'chargebee_create_subscription';
    }

    /**
     * {@inheritdoc}
     */
    public function description(): string
    {
        return 'Create a new subscription in Chargebee. Provide a customer ID or customer details along with a plan ID. Supports trial periods, coupons, and addon assignments.';
    }

    /**
     * {@inheritdoc}
     */
    public function parameters(): array
    {
        return [
            'customer_id' => ['type' => 'string', 'description' => 'Existing customer ID to subscribe.'],
            'customer_email' => ['type' => 'string', 'description' => 'Email for a new customer (used if customer_id is not provided).'],
            'customer_first_name' => ['type' => 'string', 'description' => 'First name for a new customer.'],
            'customer_last_name' => ['type' => 'string', 'description' => 'Last name for a new customer.'],
            'plan_id' => ['type' => 'string', 'required' => true, 'description' => 'The plan ID to subscribe to.'],
            'plan_quantity' => ['type' => 'integer', 'description' => 'Quantity for the plan (default: 1).'],
            'trial_end' => ['type' => 'string', 'description' => 'End of trial period (Unix timestamp or "now").'],
            'coupon' => ['type' => 'string', 'description' => 'Coupon ID to apply.'],
            'addons' => ['type' => 'array', 'description' => 'Array of addon objects with id and quantity, e.g. [{"id": "addon_x", "quantity": 2}].'],
        ];
    }

    /**
     * Execute the create subscription request.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Chargebee integration is not configured.');
            }

            if (empty($args['plan_id'])) {
                return ToolResult::error('Plan ID is required.');
            }

            $params = [
                'plan_id' => $args['plan_id'],
            ];

            // Customer identification
            if (!empty($args['customer_id'])) {
                $params['customer_id'] = $args['customer_id'];
            } else {
                if (!empty($args['customer_email'])) {
                    $params['customer[email]'] = $args['customer_email'];
                }
                if (!empty($args['customer_first_name'])) {
                    $params['customer[first_name]'] = $args['customer_first_name'];
                }
                if (!empty($args['customer_last_name'])) {
                    $params['customer[last_name]'] = $args['customer_last_name'];
                }
            }

            // Plan options
            if (isset($args['plan_quantity'])) {
                $params['plan_quantity'] = (int) $args['plan_quantity'];
            }
            if (!empty($args['trial_end'])) {
                $params['trial_end'] = $args['trial_end'];
            }
            if (!empty($args['coupon'])) {
                $params['coupon'] = $args['coupon'];
            }

            // Addons
            if (!empty($args['addons']) && is_array($args['addons'])) {
                foreach ($args['addons'] as $i => $addon) {
                    $params["addons[$i][id]"] = $addon['id'];
                    if (isset($addon['quantity'])) {
                        $params["addons[$i][quantity]"] = (int) $addon['quantity'];
                    }
                }
            }

            $result = $this->service->createSubscription($params);

            $subscription = $result['subscription'] ?? $result;
            $customer = $result['customer'] ?? null;
            $invoice = $result['invoice'] ?? null;

            $response = ['subscription' => $subscription];
            if ($customer !== null) {
                $response['customer'] = $customer;
            }
            if ($invoice !== null) {
                $response['invoice'] = $invoice;
            }

            return ToolResult::success($response);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
