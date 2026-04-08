<?php

namespace OpenCompany\Integrations\Stripe\Tools;

use OpenCompany\Integrations\Stripe\StripeService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Delete a Stripe customer by ID.
 *
 * Permanently removes the customer and all associated data.
 */
class StripeDeleteCustomer implements Tool
{
    /**
     * @param  StripeService  $service  The Stripe API client
     */
    public function __construct(
        private StripeService $service,
    ) {}

    public function name(): string
    {
        return 'stripe_delete_customer';
    }

    public function description(): string
    {
        return <<<'MD'
        Delete a Stripe customer by ID.
        Permanently removes the customer and all associated data.
        MD;
    }

    public function parameters(): array
    {
        return [
            'id' => ['type' => 'string', 'required' => true, 'description' => 'Stripe customer ID to delete (e.g., "cus_...").'],
        ];
    }

    /**
     * Delete a Stripe customer permanently by ID.
     *
     * @param  array<string, mixed>  $args  Tool arguments (id)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Stripe integration is not configured.');
            }

            $id = $args['id'] ?? '';
            if (empty($id)) {
                return ToolResult::error('id is required.');
            }

            $result = $this->service->deleteCustomer($id);

            return ToolResult::success([
                'id' => $result['id'] ?? $id,
                'deleted' => $result['deleted'] ?? true,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
