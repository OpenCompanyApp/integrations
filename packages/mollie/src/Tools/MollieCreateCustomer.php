<?php

namespace OpenCompany\Integrations\Mollie\Tools;

use OpenCompany\Integrations\Mollie\MollieService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Create a new Mollie customer.
 *
 * Requires a name and email address. Returns the created customer resource.
 */
class MollieCreateCustomer implements Tool
{
    /**
     * @param  MollieService  $service  The Mollie API client.
     */
    public function __construct(
        private MollieService $service,
    ) {}

    /**
     * Get the tool name identifier.
     */
    public function name(): string
    {
        return 'mollie_create_customer';
    }

    /**
     * Get the tool description for AI agents.
     */
    public function description(): string
    {
        return 'Create a new Mollie customer. Requires name and email. Returns the customer resource with an ID for creating subscriptions.';
    }

    /**
     * Get the tool parameter definitions.
     *
     * @return array<string, array{type: string, required?: bool, description: string}>
     */
    public function parameters(): array
    {
        return [
            'name' => ['type' => 'string', 'required' => true, 'description' => 'Full name of the customer.'],
            'email' => ['type' => 'string', 'required' => true, 'description' => 'Email address of the customer.'],
            'locale' => ['type' => 'string', 'description' => 'Preferred locale (e.g., "nl_NL", "en_US").'],
            'metadata' => ['type' => 'object', 'description' => 'Custom metadata to attach to the customer.'],
        ];
    }

    /**
     * Execute the create customer tool.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Mollie integration is not configured.');
            }

            if (empty($args['name'])) {
                return ToolResult::error('Customer name is required.');
            }

            if (empty($args['email'])) {
                return ToolResult::error('Customer email is required.');
            }

            $data = [
                'name' => $args['name'],
                'email' => $args['email'],
            ];

            if (isset($args['locale'])) {
                $data['locale'] = $args['locale'];
            }
            if (isset($args['metadata'])) {
                $data['metadata'] = $args['metadata'];
            }

            $result = $this->service->createCustomer($data);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
