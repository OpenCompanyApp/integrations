<?php

namespace OpenCompany\Integrations\ConstantContact\Tools;

use OpenCompany\Integrations\ConstantContact\ConstantContactService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Create a new contact in Constant Contact.
 *
 * Creates a new contact with an email address, and optionally sets
 * the first name, last name, and list memberships.
 */
class ConstantContactCreateContact implements Tool
{
    /**
     * Create a new ConstantContactCreateContact tool instance.
     */
    public function __construct(
        private ConstantContactService $service,
    ) {}

    /**
     * Return the tool name used for routing.
     */
    public function name(): string
    {
        return 'constantcontact_create_contact';
    }

    /**
     * Return a human-readable description of what this tool does.
     */
    public function description(): string
    {
        return 'Create a new contact in Constant Contact with an email address, first name, and last name.';
    }

    /**
     * Define the parameters this tool accepts.
     *
     * @return array<string, array<string, mixed>> Parameter definitions
     */
    public function parameters(): array
    {
        return [
            'email_address' => ['type' => 'string', 'required' => true, 'description' => 'Contact email address.'],
            'first_name' => ['type' => 'string', 'description' => 'Contact first name.'],
            'last_name' => ['type' => 'string', 'description' => 'Contact last name.'],
            'list_ids' => ['type' => 'array', 'description' => 'Array of list IDs to add the contact to upon creation.'],
        ];
    }

    /**
     * Execute the tool: create a new contact in Constant Contact.
     *
     * @param  array<string, mixed>  $args  Tool arguments
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Constant Contact integration is not configured.');
            }

            if (empty($args['email_address'])) {
                return ToolResult::error('email_address is required.');
            }

            $result = $this->service->createContact(
                email: $args['email_address'],
                firstName: $args['first_name'] ?? null,
                lastName: $args['last_name'] ?? null,
                listIds: $args['list_ids'] ?? [],
            );

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
