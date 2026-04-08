<?php

namespace OpenCompany\Integrations\ZendeskSell\Tools;

use OpenCompany\Integrations\ZendeskSell\ZendeskSellService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Create a new contact in Zendesk Sell.
 *
 * Creates a contact with the provided first name, last name, email, and
 * optional organization association. Returns the newly created contact
 * with its assigned ID and all fields.
 */
class ZendeskSellCreateContact implements Tool
{
    public function __construct(
        private ZendeskSellService $service,
    ) {}

    public function name(): string
    {
        return 'zendesk_sell_create_contact';
    }

    public function description(): string
    {
        return 'Create a new contact in Zendesk Sell. Provide at least a first name and last name. Optionally include email and organization ID to associate the contact with an existing organization.';
    }

    public function parameters(): array
    {
        return [
            'first_name' => ['type' => 'string', 'required' => true, 'description' => 'Contact first name.'],
            'last_name' => ['type' => 'string', 'required' => true, 'description' => 'Contact last name.'],
            'email' => ['type' => 'string', 'description' => 'Contact email address.'],
            'organization_id' => ['type' => 'integer', 'description' => 'ID of the organization to associate this contact with.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Zendesk Sell integration is not configured.');
            }

            if (empty($args['first_name'])) {
                return ToolResult::error('First name is required.');
            }

            if (empty($args['last_name'])) {
                return ToolResult::error('Last name is required.');
            }

            $data = [
                'first_name' => $args['first_name'],
                'last_name' => $args['last_name'],
            ];

            if (isset($args['email'])) {
                $data['email'] = $args['email'];
            }

            if (isset($args['organization_id'])) {
                $data['organization_id'] = (int) $args['organization_id'];
            }

            $result = $this->service->createContact($data);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
