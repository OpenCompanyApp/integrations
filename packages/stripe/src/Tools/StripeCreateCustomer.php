<?php

namespace OpenCompany\Integrations\Stripe\Tools;

use OpenCompany\Integrations\Stripe\StripeService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Create a new Stripe customer.
 *
 * Supports name, email, description, phone, and custom metadata.
 */
class StripeCreateCustomer implements Tool
{
    /**
     * @param  StripeService  $service  The Stripe API client
     */
    public function __construct(
        private StripeService $service,
    ) {}

    public function name(): string
    {
        return 'stripe_create_customer';
    }

    public function description(): string
    {
        return <<<'MD'
        Create a new Stripe customer.
        Supports name, email, description, phone, and metadata.
        Returns the created customer object with ID.
        MD;
    }

    public function parameters(): array
    {
        return [
            'name' => ['type' => 'string', 'description' => 'Customer display name.'],
            'email' => ['type' => 'string', 'description' => 'Customer email address.'],
            'description' => ['type' => 'string', 'description' => 'Internal description for this customer.'],
            'phone' => ['type' => 'string', 'description' => 'Customer phone number.'],
            'metadata' => ['type' => 'object', 'description' => 'Key-value pairs for additional metadata.'],
        ];
    }

    /**
     * Create a new customer in Stripe.
     *
     * @param  array<string, mixed>  $args  Tool arguments (name, email, description, phone, metadata)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Stripe integration is not configured.');
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

            $result = $this->service->createCustomer($data);

            return ToolResult::success([
                'id' => $result['id'] ?? '',
                'name' => $result['name'] ?? '',
                'email' => $result['email'] ?? '',
                'phone' => $result['phone'] ?? null,
                'created' => $result['created'] ?? null,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
