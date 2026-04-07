<?php

namespace OpenCompany\Integrations\Square\Tools;

use OpenCompany\Integrations\Square\SquareService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Retrieve a Square customer by ID.
 *
 * Returns full customer details including email, phone, address, and cards on file.
 */
class SquareGetCustomer implements Tool
{
    /**
     * @param  SquareService  $service  The Square API client
     */
    public function __construct(
        private SquareService $service,
    ) {}

    public function name(): string
    {
        return 'square_get_customer';
    }

    public function description(): string
    {
        return <<<'MD'
        Retrieve a Square customer by ID.
        Returns full customer details including email, phone, address, and cards on file.
        MD;
    }

    public function parameters(): array
    {
        return [
            'id' => ['type' => 'string', 'required' => true, 'description' => 'Square customer ID.'],
        ];
    }

    /**
     * Retrieve a Square customer by ID with full details.
     *
     * @param  array<string, mixed>  $args  Tool arguments (id)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Square integration is not configured.');
            }

            $id = $args['id'] ?? '';
            if (empty($id)) {
                return ToolResult::error('id is required.');
            }

            $result = $this->service->getCustomer($id);
            $customer = $result['customer'] ?? [];

            return ToolResult::success([
                'id' => $customer['id'] ?? '',
                'given_name' => $customer['given_name'] ?? '',
                'family_name' => $customer['family_name'] ?? '',
                'email_address' => $customer['email_address'] ?? '',
                'phone_number' => $customer['phone_number'] ?? null,
                'address' => $customer['address'] ?? null,
                'company_name' => $customer['company_name'] ?? null,
                'note' => $customer['note'] ?? null,
                'cards' => $customer['cards'] ?? [],
                'created_at' => $customer['created_at'] ?? null,
                'updated_at' => $customer['updated_at'] ?? null,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
