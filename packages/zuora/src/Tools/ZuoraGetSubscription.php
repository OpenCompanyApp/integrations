<?php

namespace OpenCompany\Integrations\Zuora\Tools;

use OpenCompany\Integrations\Zuora\ZuoraService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get a single Zuora subscription by ID.
 *
 * Retrieves detailed information about a specific subscription including
 * its rate plans, charges, terms, and lifecycle dates.
 */
class ZuoraGetSubscription implements Tool
{
    /**
     * Create a new ZuoraGetSubscription tool instance.
     */
    public function __construct(
        private ZuoraService $service,
    ) {}

    /**
     * Get the tool name identifier.
     */
    public function name(): string
    {
        return 'zuora_get_subscription';
    }

    /**
     * Get the tool description for AI agent context.
     */
    public function description(): string
    {
        return 'Get details of a specific Zuora subscription by its ID. Returns subscription status, rate plans, charges, and key dates.';
    }

    /**
     * Get the tool parameter schema.
     *
     * @return array<string, array{type: string, description?: string, required?: bool}>
     */
    public function parameters(): array
    {
        return [
            'subscription_id' => ['type' => 'string', 'required' => true, 'description' => 'The Zuora subscription ID (e.g., "8a90b89a8a...").'],
        ];
    }

    /**
     * Execute the tool — get a Zuora subscription.
     *
     * @param  array<string, mixed> $args Tool arguments
     * @return ToolResult The result containing subscription details or an error message
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Zuora integration is not configured.');
            }

            $subscriptionId = $args['subscription_id'] ?? '';

            if (empty($subscriptionId)) {
                return ToolResult::error('Subscription ID is required.');
            }

            $result = $this->service->getSubscription($subscriptionId);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
