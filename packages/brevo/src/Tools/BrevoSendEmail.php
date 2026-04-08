<?php

namespace OpenCompany\Integrations\Brevo\Tools;

use OpenCompany\Integrations\Brevo\BrevoService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class BrevoSendEmail implements Tool
{
    public function __construct(
        private BrevoService $service,
    ) {}

    public function name(): string
    {
        return 'brevo_send_email';
    }

    public function description(): string
    {
        return 'Send a transactional email via Brevo. Specify sender, recipients, subject, and HTML or text content.';
    }

    public function parameters(): array
    {
        return [
            'sender' => ['type' => 'object', 'required' => true, 'description' => 'Sender details as an object with "name" and "email" keys, e.g. {"name": "My App", "email": "noreply@example.com"}.'],
            'to' => ['type' => 'array', 'required' => true, 'description' => 'Array of recipient objects, each with "email" and optionally "name", e.g. [{"email": "user@example.com", "name": "John"}].'],
            'subject' => ['type' => 'string', 'required' => true, 'description' => 'The email subject line.'],
            'htmlContent' => ['type' => 'string', 'description' => 'HTML body of the email. Required unless textContent is provided.'],
            'textContent' => ['type' => 'string', 'description' => 'Plain text body of the email. Required unless htmlContent is provided.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Brevo integration is not configured.');
            }

            $sender = $args['sender'] ?? [];
            $to = $args['to'] ?? [];
            $subject = $args['subject'] ?? '';

            if (empty($sender) || empty($sender['email'])) {
                return ToolResult::error('Sender with an email address is required.');
            }

            if (empty($to)) {
                return ToolResult::error('At least one recipient is required.');
            }

            if (empty($subject)) {
                return ToolResult::error('Subject is required.');
            }

            $data = [
                'sender' => $sender,
                'to' => $to,
                'subject' => $subject,
            ];

            if (isset($args['htmlContent'])) {
                $data['htmlContent'] = $args['htmlContent'];
            }

            if (isset($args['textContent'])) {
                $data['textContent'] = $args['textContent'];
            }

            if (empty($data['htmlContent']) && empty($data['textContent'])) {
                return ToolResult::error('Either htmlContent or textContent must be provided.');
            }

            $result = $this->service->sendEmail($data);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
