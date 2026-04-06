<?php

namespace OpenCompany\Integrations\Chargify\Tools;

use OpenCompany\Integrations\Chargify\ChargifyService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get a single subscription by its Chargify ID.
 *
 * Returns full subscription details including customer, product, billing period,
 * pricing, and payment profile information.
 */
class ChargifyGetSubscription implements Tool
{
    public function __construct(
        private ChargifyService $service,
    ) {}

    public function name(): string
    {
        return 'chargify_get_subscription';
    }

    public function description(): string
    {
        return 'Get detailed information for a single Chargify subscription by ID.';
    }

    public function parameters(): array
    {
        return [
            'subscription_id' => ['type' => 'integer', 'required' => true, 'description' => 'The Chargify subscription ID.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Chargify integration is not configured.');
            }

            if (!isset($args['subscription_id'])) {
                return ToolResult::error('subscription_id is required.');
            }

            $result = $this->service->getSubscription((int) $args['subscription_id']);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
