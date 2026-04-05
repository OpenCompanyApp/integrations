<?php

namespace OpenCompany\Integrations\Wealthbox\Tools;

use OpenCompany\Integrations\Wealthbox\WealthboxService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class WealthboxCreateContact implements Tool
{
    /**
     * Create a new WealthboxCreateContact tool instance.
     */
    public function __construct(
        private WealthboxService $service,
    ) {}

    /**
     * Get the tool name identifier.
     */
    public function name(): string
    {
        return 'wealthbox_create_contact';
    }

    /**
     * Get the tool description.
     */
    public function description(): string
    {
        return 'Create a new contact in Wealthbox CRM. At minimum provide a first name or last name. You can also include email, phone, address, and other contact details.';
    }

    /**
     * Get the tool parameters schema.
     *
     * @return array<string, array<string, mixed>>
     */
    public function parameters(): array
    {
        return [
            'first_name' => ['type' => 'string', 'description' => 'Contact\'s first name.'],
            'last_name' => ['type' => 'string', 'description' => 'Contact\'s last name.'],
            'email' => ['type' => 'string', 'description' => 'Contact\'s email address.'],
            'phone' => ['type' => 'string', 'description' => 'Contact\'s phone number.'],
            'street' => ['type' => 'string', 'description' => 'Street address.'],
            'city' => ['type' => 'string', 'description' => 'City.'],
            'state' => ['type' => 'string', 'description' => 'State or province.'],
            'zip' => ['type' => 'string', 'description' => 'ZIP or postal code.'],
            'type' => ['type' => 'string', 'description' => 'Contact type (e.g., "Client", "Prospect", "Lead").'],
            'tags' => ['type' => 'array', 'description' => 'Tags to assign to the contact.'],
        ];
    }

    /**
     * Execute the create contact tool.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Wealthbox integration is not configured.');
            }

            if (empty($args['first_name']) && empty($args['last_name'])) {
                return ToolResult::error('At least a first_name or last_name is required to create a contact.');
            }

            $data = array_filter([
                'first_name' => $args['first_name'] ?? null,
                'last_name' => $args['last_name'] ?? null,
                'email' => $args['email'] ?? null,
                'phone' => $args['phone'] ?? null,
                'street' => $args['street'] ?? null,
                'city' => $args['city'] ?? null,
                'state' => $args['state'] ?? null,
                'zip' => $args['zip'] ?? null,
                'type' => $args['type'] ?? null,
                'tags' => $args['tags'] ?? null,
            ], fn ($value) => $value !== null);

            $result = $this->service->createContact($data);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
