<?php

namespace OpenCompany\Integrations\Resend\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Resend\ResendService;

/**
 * Create a contact in a Resend audience.
 */
class ResendCreateContact implements Tool
{
    /** @param ResendService $service The Resend API client */
    public function __construct(
        private ResendService $service,
    ) {}

    public function name(): string
    {
        return 'resend_create_contact';
    }

    public function description(): string
    {
        return <<<'MD'
        Create a contact in a Resend audience. Requires the audience ID and the contact's
        email address. Optionally provide first name, last name, and unsubscribed status.
        Returns the created contact object.
        MD;
    }

    public function parameters(): array
    {
        return [
            'audience_id' => [
                'type'        => 'string',
                'required'    => true,
                'description' => 'The audience ID to add the contact to.',
            ],
            'email' => [
                'type'        => 'string',
                'required'    => true,
                'description' => 'Contact email address.',
            ],
            'first_name' => [
                'type'        => 'string',
                'description' => 'Contact first name.',
            ],
            'last_name' => [
                'type'        => 'string',
                'description' => 'Contact last name.',
            ],
            'unsubscribed' => [
                'type'        => 'boolean',
                'description' => 'Whether the contact is unsubscribed (default false).',
            ],
        ];
    }

    /** @param array<string, mixed> $args Tool arguments */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Resend integration is not configured.');
            }

            $audienceId = $args['audience_id'] ?? '';
            if (empty($audienceId)) {
                return ToolResult::error('The "audience_id" parameter is required.');
            }

            $email = $args['email'] ?? '';
            if (empty($email)) {
                return ToolResult::error('The "email" parameter is required.');
            }

            $result = $this->service->createContact(
                audienceId: $audienceId,
                email: $email,
                firstName: $args['first_name'] ?? null,
                lastName: $args['last_name'] ?? null,
                unsubscribed: $args['unsubscribed'] ?? null,
            );

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
