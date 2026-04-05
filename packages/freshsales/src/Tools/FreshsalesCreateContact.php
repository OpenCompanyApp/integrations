<?php

namespace OpenCompany\Integrations\Freshsales\Tools;

use OpenCompany\Integrations\Freshsales\FreshsalesService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class FreshsalesCreateContact implements Tool
{
    /**
     * Create a new FreshsalesCreateContact tool instance.
     */
    public function __construct(
        private FreshsalesService $service,
    ) {}

    /**
     * Get the tool name.
     */
    public function name(): string
    {
        return 'freshsales_create_contact';
    }

    /**
     * Get the tool description.
     */
    public function description(): string
    {
        return 'Create a new contact in Freshsales CRM. Requires at least a first name or last name.';
    }

    /**
     * Get the tool parameter definitions.
     *
     * @return array<string, array<string, mixed>>
     */
    public function parameters(): array
    {
        return [
            'first_name' => ['type' => 'string', 'description' => 'First name of the contact.'],
            'last_name' => ['type' => 'string', 'description' => 'Last name of the contact.'],
            'email' => ['type' => 'string', 'description' => 'Primary email address.'],
            'work_number' => ['type' => 'string', 'description' => 'Work phone number.'],
            'mobile_number' => ['type' => 'string', 'description' => 'Mobile phone number.'],
            'job_title' => ['type' => 'string', 'description' => 'Job title.'],
            'sales_account_id' => ['type' => 'integer', 'description' => 'ID of the sales account to link.'],
            'address' => ['type' => 'string', 'description' => 'Street address.'],
            'city' => ['type' => 'string', 'description' => 'City.'],
            'state' => ['type' => 'string', 'description' => 'State or province.'],
            'zipcode' => ['type' => 'string', 'description' => 'Postal / ZIP code.'],
            'country' => ['type' => 'string', 'description' => 'Country name.'],
        ];
    }

    /**
     * Execute the tool with the given arguments.
     *
     * @param  array<string, mixed>  $args
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Freshsales integration is not configured.');
            }

            if (empty($args['first_name']) && empty($args['last_name'])) {
                return ToolResult::error('At least a first name or last name is required.');
            }

            $data = array_filter([
                'first_name' => $args['first_name'] ?? null,
                'last_name' => $args['last_name'] ?? null,
                'email' => $args['email'] ?? null,
                'work_number' => $args['work_number'] ?? null,
                'mobile_number' => $args['mobile_number'] ?? null,
                'job_title' => $args['job_title'] ?? null,
                'sales_account_id' => $args['sales_account_id'] ?? null,
                'address' => $args['address'] ?? null,
                'city' => $args['city'] ?? null,
                'state' => $args['state'] ?? null,
                'zipcode' => $args['zipcode'] ?? null,
                'country' => $args['country'] ?? null,
            ], fn ($value) => $value !== null);

            $result = $this->service->createContact($data);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
