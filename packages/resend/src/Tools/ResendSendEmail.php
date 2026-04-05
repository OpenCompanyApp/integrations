<?php

namespace OpenCompany\Integrations\Resend\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Resend\ResendService;

/**
 * Send an email via the Resend API.
 */
class ResendSendEmail implements Tool
{
    /** @param ResendService $service The Resend API client */
    public function __construct(
        private ResendService $service,
    ) {}

    public function name(): string
    {
        return 'resend_send_email';
    }

    public function description(): string
    {
        return <<<'MD'
        Send an email through Resend. Supports HTML and plain-text content, CC, BCC,
        reply-to, tags for categorization, and custom email headers.
        Returns the sent email object including its ID.
        MD;
    }

    public function parameters(): array
    {
        return [
            'to' => [
                'type'        => 'string',
                'required'    => true,
                'description' => 'Recipient email address.',
            ],
            'from' => [
                'type'        => 'string',
                'required'    => true,
                'description' => 'Sender email address (must be a verified domain).',
            ],
            'subject' => [
                'type'        => 'string',
                'required'    => true,
                'description' => 'Email subject line.',
            ],
            'html' => [
                'type'        => 'string',
                'description' => 'HTML body content.',
            ],
            'text' => [
                'type'        => 'string',
                'description' => 'Plain-text body content.',
            ],
            'cc' => [
                'type'        => 'array',
                'description' => 'CC recipient email addresses.',
                'items'       => ['type' => 'string'],
            ],
            'bcc' => [
                'type'        => 'array',
                'description' => 'BCC recipient email addresses.',
                'items'       => ['type' => 'string'],
            ],
            'reply_to' => [
                'type'        => 'array',
                'description' => 'Reply-to email addresses.',
                'items'       => ['type' => 'string'],
            ],
            'tags' => [
                'type'        => 'array',
                'description' => 'Tags to attach to the email. Each item should have "name" and "value" keys.',
                'items'       => ['type' => 'object'],
            ],
            'headers' => [
                'type'        => 'object',
                'description' => 'Custom email headers (key-value pairs).',
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
                html: $args['html'] ?? null,
                text: $args['text'] ?? null,
                cc: $args['cc'] ?? null,
                bcc: $args['bcc'] ?? null,
                replyTo: $args['reply_to'] ?? null,
                tags: $args['tags'] ?? [],
                headers: $args['headers'] ?? [],
            );

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
