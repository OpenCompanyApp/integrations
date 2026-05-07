<?php

namespace OpenCompany\Integrations\Square\Tools;

use OpenCompany\Integrations\Square\SquareService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Create a Square customer profile.
 *
 * Accepts basic name, email, and phone fields and includes an idempotency key
 * for safe retries.
 */
class SquareCreateCustomer implements Tool
{
    /**
     * Create a new SquareCreateCustomer tool instance.
     */
    public function __construct(
        private SquareService $service,
    ) {}

    /**
     * Get the tool name.
     */
    public function name(): string
    {
        return 'square_create_customer';
    }

    /**
     * Get the tool description.
     */
    public function description(): string
    {
        return 'Create a new customer profile in Square with name, email, and phone details.';
    }

    /**
     * Get the tool parameter definitions.
     *
     * @return array<string, array<string, mixed>>
     */
    public function parameters(): array
    {
        return [
            'given_name' => ['type' => 'string', 'description' => 'The customer\'s first name.'],
            'family_name' => ['type' => 'string', 'description' => 'The customer\'s last name.'],
            'email_address' => ['type' => 'string', 'description' => 'The customer\'s email address.'],
            'phone_number' => ['type' => 'string', 'description' => 'The customer\'s phone number (E.164 format, e.g., "+15551234567").'],
        ];
    }

    /**
     * Execute the tool.
     *
     * @param  array<string, mixed>  $args  Tool arguments
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Square integration is not configured.');
            }

            $data = [];

            if (isset($args['given_name'])) {
                $data['given_name'] = $args['given_name'];
            }
            if (isset($args['family_name'])) {
                $data['family_name'] = $args['family_name'];
            }
            if (isset($args['email_address'])) {
                $data['email_address'] = $args['email_address'];
            }
            if (isset($args['phone_number'])) {
                $data['phone_number'] = $args['phone_number'];
            }

            if (empty($data)) {
                return ToolResult::error('At least one customer field (given_name, family_name, email_address, or phone_number) is required.');
            }

            // Include an idempotency key for safe retries
            $data['idempotency_key'] = $args['idempotency_key'] ?? uniqid('square_customer_', true);

            $result = $this->service->createCustomer($data);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
