<?php

namespace OpenCompany\Integrations\Sendgrid\Tools;

use OpenCompany\Integrations\Sendgrid\SendgridService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class SendgridSendEmail implements Tool
{
    public function __construct(
        private SendgridService $service,
    ) {}

    public function name(): string
    {
        return 'sendgrid_send_email';
    }

    public function description(): string
    {
        return 'Send an email via SendGrid. Specify sender, recipients, subject, and HTML or text content.';
    }

    public function parameters(): array
    {
        return [
            'from' => ['type' => 'object', 'required' => true, 'description' => 'Sender details as an object with "email" and optionally "name" keys, e.g. {"email": "noreply@example.com", "name": "My App"}.'],
            'to' => ['type' => 'array', 'required' => true, 'description' => 'Array of recipient objects, each with "email" and optionally "name", e.g. [{"email": "user@example.com", "name": "John"}].'],
            'subject' => ['type' => 'string', 'required' => true, 'description' => 'The email subject line.'],
            'htmlContent' => ['type' => 'string', 'description' => 'HTML body of the email.'],
            'textContent' => ['type' => 'string', 'description' => 'Plain text body of the email.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('SendGrid integration is not configured.');
            }

            $from = $args['from'] ?? [];
            $to = $args['to'] ?? [];
            $subject = $args['subject'] ?? '';

            if (empty($from) || empty($from['email'])) {
                return ToolResult::error('Sender with an email address is required.');
            }

            if (empty($to)) {
                return ToolResult::error('At least one recipient is required.');
            }

            if (empty($subject)) {
                return ToolResult::error('Subject is required.');
            }

            $content = [];
            if (isset($args['htmlContent'])) {
                $content[] = ['type' => 'text/html', 'value' => $args['htmlContent']];
            }
            if (isset($args['textContent'])) {
                $content[] = ['type' => 'text/plain', 'value' => $args['textContent']];
            }

            if (empty($content)) {
                return ToolResult::error('Either htmlContent or textContent must be provided.');
            }

            $data = [
                'from' => $from,
                'personalizations' => [
                    [
                        'to' => array_map(function ($recipient) {
                            return array_filter([
                                'email' => $recipient['email'] ?? '',
                                'name' => $recipient['name'] ?? null,
                            ], fn($v) => $v !== null);
                        }, $to),
                    ],
                ],
                'subject' => $subject,
                'content' => $content,
            ];

            $result = $this->service->sendEmail($data);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
