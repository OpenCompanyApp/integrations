<?php

namespace OpenCompany\Integrations\Mailjet\Tools;

use OpenCompany\Integrations\Mailjet\MailjetService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class MailjetSendEmail implements Tool
{
    public function __construct(
        private MailjetService $service,
    ) {}

    public function name(): string
    {
        return 'mailjet_send_email';
    }

    public function description(): string
    {
        return 'Send an email via Mailjet. Specify sender, one or more recipients, subject, and HTML body.';
    }

    public function parameters(): array
    {
        return [
            'from_email' => ['type' => 'string', 'required' => true, 'description' => 'Sender email address (must be a verified sender in Mailjet).'],
            'from_name' => ['type' => 'string', 'description' => 'Sender display name.'],
            'to_email' => ['type' => 'string', 'required' => true, 'description' => 'Recipient email address. For multiple recipients, use to_emails instead.'],
            'to_emails' => ['type' => 'array', 'description' => 'Array of recipient email addresses. Use this OR to_email, not both.'],
            'subject' => ['type' => 'string', 'required' => true, 'description' => 'Email subject line.'],
            'html' => ['type' => 'string', 'description' => 'HTML body of the email.'],
            'text' => ['type' => 'string', 'description' => 'Plain-text body of the email (fallback when HTML is not supported).'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Mailjet integration is not configured.');
            }

            $from = ['Email' => $args['from_email']];
            if (isset($args['from_name'])) {
                $from['Name'] = $args['from_name'];
            }

            $recipients = [];
            if (isset($args['to_emails']) && is_array($args['to_emails'])) {
                foreach ($args['to_emails'] as $email) {
                    $recipients[] = ['Email' => $email];
                }
            } elseif (isset($args['to_email'])) {
                $recipients[] = ['Email' => $args['to_email']];
            } else {
                return ToolResult::error('Either to_email or to_emails is required.');
            }

            $payload = [
                'From' => $from,
                'To' => $recipients,
                'Subject' => $args['subject'],
            ];

            if (isset($args['html'])) {
                $payload['HTML'] = $args['html'];
            }

            if (isset($args['text'])) {
                $payload['Text'] = $args['text'];
            }

            $result = $this->service->sendEmail($payload);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
