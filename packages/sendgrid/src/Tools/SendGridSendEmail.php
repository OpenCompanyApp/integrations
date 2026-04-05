<?php

namespace OpenCompany\Integrations\SendGrid\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\SendGrid\SendGridService;

/**
 * Send an email via the SendGrid Mail Send API.
 */
class SendGridSendEmail implements Tool
{
    /** @param SendGridService $service The SendGrid API client */
    public function __construct(
        private SendGridService $service,
    ) {}

    public function name(): string
    {
        return 'sendgrid_send_email';
    }

    public function description(): string
    {
        return <<<'MD'
        Send an email through SendGrid. Supports HTML and plain-text content, CC, BCC,
        reply-to, categories, and custom arguments for webhook tracking.
        Returns a success indicator — SendGrid responds with 202 Accepted and no body.
        MD;
    }

    public function parameters(): array
    {
        return [
            'to' => [
                'type' => 'string',
                'required' => true,
                'description' => 'Recipient email address.',
            ],
            'from' => [
                'type' => 'string',
                'required' => true,
                'description' => 'Sender email address (must be a verified sender identity).',
            ],
            'subject' => [
                'type' => 'string',
                'required' => true,
                'description' => 'Email subject line.',
            ],
            'html_content' => [
                'type' => 'string',
                'description' => 'HTML body content.',
            ],
            'plain_content' => [
                'type' => 'string',
                'description' => 'Plain-text body content.',
            ],
            'reply_to' => [
                'type' => 'string',
                'description' => 'Reply-to email address.',
            ],
            'cc' => [
                'type' => 'array',
                'description' => 'CC recipient email addresses.',
                'items' => ['type' => 'string'],
            ],
            'bcc' => [
                'type' => 'array',
                'description' => 'BCC recipient email addresses.',
                'items' => ['type' => 'string'],
            ],
            'categories' => [
                'type' => 'array',
                'description' => 'Categories to attach to the email for analytics.',
                'items' => ['type' => 'string'],
            ],
            'custom_args' => [
                'type' => 'object',
                'description' => 'Custom arguments for event webhooks (key-value pairs).',
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

            $to = $args['to'] ?? '';
            if (empty($to)) {
                return ToolResult::error('The "to" parameter is required.');
            }

            $from = $args['from'] ?? '';
            if (empty($from)) {
                return ToolResult::error('The "from" parameter is required.');
            }

            $subject = $args['subject'] ?? '';
            if (empty($subject)) {
                return ToolResult::error('The "subject" parameter is required.');
            }

            $result = $this->service->sendEmail(
                to: $to,
                from: $from,
                subject: $subject,
                htmlContent: $args['html_content'] ?? null,
                plainContent: $args['plain_content'] ?? null,
                replyTo: $args['reply_to'] ?? null,
                cc: $args['cc'] ?? [],
                bcc: $args['bcc'] ?? [],
                categories: $args['categories'] ?? [],
                customArgs: $args['custom_args'] ?? [],
            );

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
