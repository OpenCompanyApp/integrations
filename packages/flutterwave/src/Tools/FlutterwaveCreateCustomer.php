<?php

namespace OpenCompany\Integrations\Flutterwave\Tools;

use OpenCompany\Integrations\Flutterwave\FlutterwaveService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Create a customer record in Flutterwave.
 *
 * Requires an email address and supports optional name and phone fields.
 */
class FlutterwaveCreateCustomer implements Tool
{
    /**
     * Create a new FlutterwaveCreateCustomer tool instance.
     *
     * @param  FlutterwaveService  $service  The Flutterwave service used to make API calls.
     */
    public function __construct(
        private FlutterwaveService $service,
    ) {}

    /**
     * The unique tool name used for registration and invocation.
     */
    public function name(): string
    {
        return 'flutterwave_create_customer';
    }

    /**
     * A human-readable description of what this tool does.
     */
    public function description(): string
    {
        return 'Create a new customer record on Flutterwave. Requires an email address.';
    }

    /**
     * The parameters this tool accepts.
     *
     * @return array<string, array{type: string, description: string, required?: bool}>
     */
    public function parameters(): array
    {
        return [
            'email' => ['type' => 'string', 'description' => 'Customer email address.', 'required' => true],
            'first_name' => ['type' => 'string', 'description' => 'Customer first name.'],
            'last_name' => ['type' => 'string', 'description' => 'Customer last name.'],
            'phone' => ['type' => 'string', 'description' => 'Customer phone number.'],
        ];
    }

    /**
     * Execute the tool: create a customer on Flutterwave.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Flutterwave integration is not configured.');
            }

            if (empty($args['email'])) {
                return ToolResult::error('The "email" parameter is required.');
            }

            $data = [
                'email' => $args['email'],
            ];

            if (isset($args['first_name'])) {
                $data['first_name'] = $args['first_name'];
            }

            if (isset($args['last_name'])) {
                $data['last_name'] = $args['last_name'];
            }

            if (isset($args['phone'])) {
                $data['phone'] = $args['phone'];
            }

            $result = $this->service->createCustomer($data);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
