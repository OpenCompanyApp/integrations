<?php

namespace OpenCompany\Integrations\Chargebee\Tools;

use OpenCompany\Integrations\Chargebee\ChargebeeService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool to create a new customer in Chargebee.
 */
class ChargebeeCreateCustomer implements Tool
{
    /**
     * Create a new ChargebeeCreateCustomer tool instance.
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
        return 'chargebee_create_customer';
    }

    /**
     * {@inheritdoc}
     */
    public function description(): string
    {
        return 'Create a new customer in Chargebee. Provide at minimum an email address. Supports company details, phone, and billing address.';
    }

    /**
     * {@inheritdoc}
     */
    public function parameters(): array
    {
        return [
            'email' => ['type' => 'string', 'required' => true, 'description' => 'Customer email address.'],
            'first_name' => ['type' => 'string', 'description' => 'Customer first name.'],
            'last_name' => ['type' => 'string', 'description' => 'Customer last name.'],
            'company' => ['type' => 'string', 'description' => 'Company name.'],
            'phone' => ['type' => 'string', 'description' => 'Phone number.'],
            'locale' => ['type' => 'string', 'description' => 'Locale for the customer (e.g., "en-US", "fr-FR").'],
            'billing_address_line1' => ['type' => 'string', 'description' => 'Billing address line 1.'],
            'billing_address_line2' => ['type' => 'string', 'description' => 'Billing address line 2.'],
            'billing_address_city' => ['type' => 'string', 'description' => 'Billing address city.'],
            'billing_address_state' => ['type' => 'string', 'description' => 'Billing address state/province.'],
            'billing_address_zip' => ['type' => 'string', 'description' => 'Billing address zip/postal code.'],
            'billing_address_country' => ['type' => 'string', 'description' => 'Billing address country code (ISO 3166-1 alpha-2, e.g., "US", "NL").'],
        ];
    }

    /**
     * Execute the create customer request.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Chargebee integration is not configured.');
            }

            if (empty($args['email'])) {
                return ToolResult::error('Email is required to create a customer.');
            }

            $params = [
                'email' => $args['email'],
            ];

            $optionalFields = [
                'first_name', 'last_name', 'company', 'phone', 'locale',
            ];

            foreach ($optionalFields as $field) {
                if (!empty($args[$field])) {
                    $params[$field] = $args[$field];
                }
            }

            // Billing address fields use dot notation in Chargebee API
            $addressFields = [
                'billing_address_line1' => 'line1',
                'billing_address_line2' => 'line2',
                'billing_address_city' => 'city',
                'billing_address_state' => 'state',
                'billing_address_zip' => 'zip',
                'billing_address_country' => 'country',
            ];

            foreach ($addressFields as $argKey => $apiField) {
                if (!empty($args[$argKey])) {
                    $params["billing_address[{$apiField}]"] = $args[$argKey];
                }
            }

            $result = $this->service->createCustomer($params);

            $customer = $result['customer'] ?? $result;
            $card = $result['card'] ?? null;

            $response = ['customer' => $customer];
            if ($card !== null) {
                $response['card'] = $card;
            }

            return ToolResult::success($response);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
