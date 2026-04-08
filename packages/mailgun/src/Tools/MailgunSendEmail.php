<?php

namespace OpenCompany\Integrations\Mailgun\Tools;

use OpenCompany\Integrations\Mailgun\MailgunService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class MailgunSendEmail implements Tool
{
    public function __construct(
        private MailgunService $service,
    ) {}

    public function name(): string
    {
        return 'mailgun_send_email';
    }

    public function description(): string
    {
        return 'Send an email via Mailgun. Specify from, to, subject, and text or HTML content.';
    }

    public function parameters(): array
    {
        return [
            'from' => ['type' => 'string', 'required' => true, 'description' => 'Sender email address, e.g. "My App <noreply@example.com>".'],
            'to' => ['type' => 'array', 'required' => true, 'description' => 'Array of recipient email addresses, e.g. ["user@example.com"] or ["John <john@example.com>"].'],
            'subject' => ['type' => 'string', 'required' => true, 'description' => 'The email subject line.'],
            'text' => ['type' => 'string', 'description' => 'Plain text body of the email. Required unless html is provided.'],
            'html' => ['type' => 'string', 'description' => 'HTML body of the email. Required unless text is provided.'],
            'cc' => ['type' => 'array', 'description' => 'Array of CC recipient email addresses.'],
            'bcc' => ['type' => 'array', 'description' => 'Array of BCC recipient email addresses.'],
            'tag' => ['type' => 'array', 'description' => 'Array of tag strings for categorization.'],
            'reply_to' => ['type' => 'string', 'description' => 'Reply-to email address.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Mailgun integration is not configured.');
            }

            $from = $args['from'] ?? '';
            $to = $args['to'] ?? [];
            $subject = $args['subject'] ?? '';

            if (empty($from)) {
                return ToolResult::error('From address is required.');
            }

            if (empty($to)) {
                return ToolResult::error('At least one recipient is required.');
            }

            if (empty($subject)) {
                return ToolResult::error('Subject is required.');
            }

            $data = array_filter([
                'from' => $from,
                'to' => $to,
                'subject' => $subject,
                'text' => $args['text'] ?? null,
                'html' => $args['html'] ?? null,
                'cc' => $args['cc'] ?? null,
                'bcc' => $args['bcc'] ?? null,
                'o:tag' => $args['tag'] ?? null,
                'h:Reply-To' => $args['reply_to'] ?? null,
            ], fn($value) => $value !== null);

            if (empty($data['text']) && empty($data['html'])) {
                return ToolResult::error('Either text or html body must be provided.');
            }

            $result = $this->service->sendEmail($data);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
