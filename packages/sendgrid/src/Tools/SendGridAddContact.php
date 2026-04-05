<?php

namespace OpenCompany\Integrations\SendGrid\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\SendGrid\SendGridService;

/**
 * Add or update a contact in SendGrid via PUT /marketing/contacts.
 */
class SendGridAddContact implements Tool
{
    /** @param SendGridService $service The SendGrid API client */
    public function __construct(
        private SendGridService $service,
    ) {}

    public function name(): string
    {
        return 'sendgrid_add_contact';
    }

    public function description(): string
    {
        return <<<'MD'
        Add a new contact or update an existing one in SendGrid. Uses a PUT upsert based
        on the email address. Optionally set first name, last name, custom fields, and
        assign the contact to one or more marketing lists.
        MD;
    }

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
            'custom_fields' => [
                'type' => 'object',
                'description' => 'Custom field values (key-value pairs).',
            ],
            'list_ids' => [
                'type' => 'array',
                'description' => 'List IDs to add the contact to.',
                'items' => ['type' => 'string'],
            ],
        ];
    }

    /** @param array<string, mixed> $args Tool arguments */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('SendGrid integration is not configured.');
            }

            $email = $args['email'] ?? '';
            if (empty($email)) {
                return ToolResult::error('The "email" parameter is required.');
            }

            $result = $this->service->addContact(
                email: $email,
                firstName: $args['first_name'] ?? null,
                lastName: $args['last_name'] ?? null,
                customFields: $args['custom_fields'] ?? [],
                listIds: $args['list_ids'] ?? [],
            );

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
