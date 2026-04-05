<?php

namespace OpenCompany\Integrations\InvoiceNinja\Tools;

use OpenCompany\Integrations\InvoiceNinja\InvoiceNinjaService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool: Create Client.
 *
 * Creates a new client in Invoice Ninja with contact details.
 */
class InvoiceNinjaCreateClient implements Tool
{
    /**
     * Create a new InvoiceNinjaCreateClient tool instance.
     */
    public function __construct(
        private InvoiceNinjaService $service,
    ) {}

    /**
     * The tool identifier.
     */
    public function name(): string
    {
        return 'invoiceninja_create_client';
    }

    /**
     * Human-readable description of what this tool does.
     */
    public function description(): string
    {
        return 'Create a new client in Invoice Ninja. Provide name and at least one contact with an email address.';
    }

    /**
     * Define the parameters this tool accepts.
     *
     * @return array<string, array{type: string, required?: bool, description: string}>
     */
    public function parameters(): array
    {
        return [
            'name' => ['type' => 'string', 'required' => true, 'description' => 'Client or company name.'],
            'contacts' => [
                'type' => 'array',
                'required' => true,
                'description' => 'Array of contacts. Each contact should have: first_name, last_name, email. Optionally: phone.',
            ],
            'id_number' => ['type' => 'string', 'description' => 'Custom ID number for the client.'],
            'vat_number' => ['type' => 'string', 'description' => 'VAT/tax identification number.'],
            'website' => ['type' => 'string', 'description' => 'Client website URL.'],
            'phone' => ['type' => 'string', 'description' => 'Primary phone number.'],
            'address1' => ['type' => 'string', 'description' => 'Street address line 1.'],
            'address2' => ['type' => 'string', 'description' => 'Street address line 2.'],
            'city' => ['type' => 'string', 'description' => 'City.'],
            'state' => ['type' => 'string', 'description' => 'State or province.'],
            'postal_code' => ['type' => 'string', 'description' => 'Postal / ZIP code.'],
            'country_id' => ['type' => 'string', 'description' => 'Country ID (ISO 3166-1 numeric).'],
            'private_notes' => ['type' => 'string', 'description' => 'Private notes (internal only).'],
            'public_notes' => ['type' => 'string', 'description' => 'Public notes visible to the client.'],
        ];
    }

    /**
     * Execute the tool and return a result.
     *
     * @param  array<string, mixed>  $args
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Invoice Ninja integration is not configured.');
            }

            $name = $args['name'] ?? '';
            if (empty($name)) {
                return ToolResult::error('Client name is required.');
            }

            $contacts = $args['contacts'] ?? [];
            if (empty($contacts)) {
                return ToolResult::error('At least one contact is required.');
            }

            $data = array_filter([
                'name' => $name,
                'contacts' => $contacts,
                'id_number' => $args['id_number'] ?? null,
                'vat_number' => $args['vat_number'] ?? null,
                'website' => $args['website'] ?? null,
                'phone' => $args['phone'] ?? null,
                'address1' => $args['address1'] ?? null,
                'address2' => $args['address2'] ?? null,
                'city' => $args['city'] ?? null,
                'state' => $args['state'] ?? null,
                'postal_code' => $args['postal_code'] ?? null,
                'country_id' => $args['country_id'] ?? null,
                'private_notes' => $args['private_notes'] ?? null,
                'public_notes' => $args['public_notes'] ?? null,
            ], fn ($value) => $value !== null);

            $result = $this->service->createClient($data);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
