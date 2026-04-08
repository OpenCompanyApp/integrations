<?php

namespace OpenCompany\Integrations\Stripe\Tools;

use OpenCompany\Integrations\Stripe\StripeService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Update an existing Stripe customer.
 *
 * Supports updating name, email, description, phone, and metadata.
 */
class StripeUpdateCustomer implements Tool
{
    /**
     * @param  StripeService  $service  The Stripe API client
     */
    public function __construct(
        private StripeService $service,
    ) {}

    public function name(): string
    {
        return 'stripe_update_customer';
    }

    public function description(): string
    {
        return <<<'MD'
        Update an existing Stripe customer.
        Supports updating name, email, description, phone, and metadata.
        MD;
    }

    public function parameters(): array
    {
        return [
            'id' => ['type' => 'string', 'required' => true, 'description' => 'Stripe customer ID (e.g., "cus_...").'],
            'name' => ['type' => 'string', 'description' => 'Updated customer display name.'],
            'email' => ['type' => 'string', 'description' => 'Updated customer email address.'],
            'description' => ['type' => 'string', 'description' => 'Updated internal description.'],
            'phone' => ['type' => 'string', 'description' => 'Updated phone number.'],
            'metadata' => ['type' => 'object', 'description' => 'Key-value pairs for additional metadata.'],
        ];
    }

    /**
     * Update an existing Stripe customer's details.
     *
     * @param  array<string, mixed>  $args  Tool arguments (id, name, email, description, phone, metadata)
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

            $data = [];

            if (isset($args['name'])) {
                $data['name'] = $args['name'];
            }
            if (isset($args['email'])) {
                $data['email'] = $args['email'];
            }
            if (isset($args['description'])) {
                $data['description'] = $args['description'];
            }
            if (isset($args['phone'])) {
                $data['phone'] = $args['phone'];
            }
            if (isset($args['metadata']) && is_array($args['metadata'])) {
                foreach ($args['metadata'] as $key => $value) {
                    $data["metadata[{$key}]"] = (string) $value;
                }
            }

            $result = $this->service->updateCustomer($id, $data);

            return ToolResult::success([
                'id' => $result['id'] ?? '',
                'name' => $result['name'] ?? '',
                'email' => $result['email'] ?? '',
                'phone' => $result['phone'] ?? null,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
