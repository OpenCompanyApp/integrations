<?php

namespace OpenCompany\Integrations\Chargebee\Tools;

use OpenCompany\Integrations\Chargebee\ChargebeeService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool to update an existing subscription in Chargebee.
 *
 * Supports changing the plan, updating addons, and modifying subscription parameters.
 */
class ChargebeeUpdateSubscription implements Tool
{
    /**
     * Create a new ChargebeeUpdateSubscription tool instance.
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
        return 'chargebee_update_subscription';
    }

    /**
     * {@inheritdoc}
     */
    public function description(): string
    {
        return 'Update an existing Chargebee subscription. Change the plan, update addon assignments, modify quantity, or apply other changes.';
    }

    /**
     * {@inheritdoc}
     */
    public function parameters(): array
    {
        return [
            'id' => ['type' => 'string', 'required' => true, 'description' => 'The subscription ID to update.'],
            'plan_id' => ['type' => 'string', 'description' => 'New plan ID to switch to.'],
            'plan_quantity' => ['type' => 'integer', 'description' => 'New quantity for the plan.'],
            'addons' => ['type' => 'array', 'description' => 'Array of addon objects with id and quantity, e.g. [{"id": "addon_x", "quantity": 2}]. Replaces existing addons.'],
            'prorate' => ['type' => 'boolean', 'description' => 'Whether to prorate charges for the change (default: true).'],
            'end_of_term' => ['type' => 'boolean', 'description' => 'Schedule the plan change at end of the current billing term.'],
            'coupon' => ['type' => 'string', 'description' => 'Coupon ID to apply.'],
        ];
    }

    /**
     * Execute the update subscription request.
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

            if (!empty($args['plan_id'])) {
                $params['plan_id'] = $args['plan_id'];
            }
            if (isset($args['plan_quantity'])) {
                $params['plan_quantity'] = (int) $args['plan_quantity'];
            }
            if (isset($args['prorate'])) {
                $params['prorate'] = $args['prorate'] ? 'true' : 'false';
            }
            if (isset($args['end_of_term'])) {
                $params['end_of_term'] = $args['end_of_term'] ? 'true' : 'false';
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

            $result = $this->service->updateSubscription($args['id'], $params);

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
