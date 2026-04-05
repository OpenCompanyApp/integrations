<?php

namespace OpenCompany\Integrations\ConstantContact\Tools;

use OpenCompany\Integrations\ConstantContact\ConstantContactService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool: Create Contact
 *
 * Creates a new contact in Constant Contact with email, name, and optional list assignments.
 */
class ConstantContactCreateContact implements Tool
{
    /**
     * @param  ConstantContactService  $service  The Constant Contact API service.
     */
    public function __construct(
        private ConstantContactService $service,
    ) {}

    /**
     * The unique tool slug.
     */
    public function name(): string
    {
        return 'constantcontact_create_contact';
    }

    /**
     * Human-readable description shown in tool catalogs and generated docs.
     */
    public function description(): string
    {
        return 'Create a new contact in Constant Contact. Requires an email address. Optionally set first name, last name, and assign to lists.';
    }

    /**
     * Parameter definitions for the tool.
     *
     * @return array<string, array<string, mixed>>
     */
    public function parameters(): array
    {
        return [
            'email' => [
                'type' => 'string',
                'required' => true,
                'description' => 'The contact\'s email address.',
            ],
            'first_name' => [
                'type' => 'string',
                'description' => 'The contact\'s first name.',
            ],
            'last_name' => [
                'type' => 'string',
                'description' => 'The contact\'s last name.',
            ],
            'list_ids' => [
                'type' => 'array',
                'description' => 'Array of list UUIDs to add the contact to. Use list_contacts or list_lists to discover available list IDs.',
                'items' => ['type' => 'string'],
            ],
        ];
    }

    /**
     * Execute the create contact tool.
     *
     * @param  array<string, mixed>  $args  Tool arguments (email, first_name, last_name, list_ids).
     * @return ToolResult
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Constant Contact integration is not configured.');
            }

            $email = $args['email'] ?? '';
            if (empty($email)) {
                return ToolResult::error('Email address is required.');
            }

            $result = $this->service->createContact(
                email: $email,
                firstName: $args['first_name'] ?? '',
                lastName: $args['last_name'] ?? '',
                listIds: $args['list_ids'] ?? [],
            );

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
