<?php

namespace OpenCompany\Integrations\SendGrid\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\SendGrid\SendGridService;

/**
 * Add email addresses to the SendGrid suppression (unsubscribe) list.
 */
class SendGridAddSuppression implements Tool
{
    /** @param SendGridService $service The SendGrid API client */
    public function __construct(
        private SendGridService $service,
    ) {}

    public function name(): string
    {
        return 'sendgrid_add_suppression';
    }

    public function description(): string
    {
        return <<<'MD'
        Add one or more email addresses to the SendGrid suppression list.
        Suppressed emails will not receive future emails from your account.
        MD;
    }

    public function parameters(): array
    {
        return [
            'emails' => [
                'type' => 'array',
                'required' => true,
                'description' => 'Array of email addresses to suppress.',
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

            $emails = $args['emails'] ?? [];
            if (empty($emails)) {
                return ToolResult::error('The "emails" parameter is required and must not be empty.');
            }

            $result = $this->service->addSuppression(emails: $emails);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
