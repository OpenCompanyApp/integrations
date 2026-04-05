<?php

namespace OpenCompany\Integrations\Resend\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Resend\ResendService;

/**
 * Retrieve a single email by ID from Resend.
 */
class ResendGetEmail implements Tool
{
    /** @param ResendService $service The Resend API client */
    public function __construct(
        private ResendService $service,
    ) {}

    public function name(): string
    {
        return 'resend_get_email';
    }

    public function description(): string
    {
        return <<<'MD'
        Retrieve a single email by its ID from Resend. Returns the email object
        including sender, recipient, subject, created_at, and delivery status.
        MD;
    }

    public function parameters(): array
    {
        return [
            'email_id' => [
                'type'        => 'string',
                'required'    => true,
                'description' => 'The ID of the email to retrieve.',
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

            $emailId = $args['email_id'] ?? '';
            if (empty($emailId)) {
                return ToolResult::error('The "email_id" parameter is required.');
            }

            $result = $this->service->getEmail($emailId);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
