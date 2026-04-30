<?php

namespace OpenCompany\Integrations\Sendgrid\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Sendgrid\SendgridService;

/**
 * Look up a SendGrid contact by their email address.
 */
class SendGridGetContactByEmail implements Tool
{
    /** @param SendgridService $service The SendGrid API client */
    public function __construct(
        private SendgridService $service,
    ) {}

    public function name(): string
    {
        return 'sendgrid_get_contact_by_email';
    }

    public function description(): string
    {
        return <<<'MD'
        Look up a SendGrid marketing contact by their email address.
        Returns the contact record if found, including ID, name, and custom fields.
        MD;
    }

    public function parameters(): array
    {
        return [
            'email' => [
                'type' => 'string',
                'required' => true,
                'description' => 'The contact\'s email address to look up.',
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

            $result = $this->service->getContactByEmail(email: $email);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
