<?php

namespace OpenCompany\Integrations\Mailtrap\Tools;

use OpenCompany\Integrations\Mailtrap\MailtrapService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class MailtrapSendTestEmail implements Tool
{
    public function __construct(
        private MailtrapService $service,
    ) {}

    public function name(): string
    {
        return 'mailtrap_send_test_email';
    }

    public function description(): string
    {
        return 'Send a test email through Mailtrap. Provide sender, recipient(s), subject, and either text or HTML body.';
    }

    public function parameters(): array
    {
        return [
            'from'    => ['type' => 'object', 'required' => true, 'description' => 'Sender object with "email" and optionally "name". E.g. {email = "me@example.com", name = "Me"}.'],
            'to'      => ['type' => 'array',  'required' => true, 'description' => 'Array of recipient objects, each with "email" and optionally "name".'],
            'subject' => ['type' => 'string', 'required' => true, 'description' => 'Email subject line.'],
            'text'    => ['type' => 'string', 'description' => 'Plain text email body.'],
            'html'    => ['type' => 'string', 'description' => 'HTML email body.'],
            'inbox_id' => ['type' => 'integer', 'description' => 'Inbox ID to send from (required for Testing inbox type).'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Mailtrap integration is not configured.');
            }

            $from = $args['from'] ?? [];
            $to = $args['to'] ?? [];
            $subject = $args['subject'] ?? '';

            if (empty($from) || !is_array($from)) {
                return ToolResult::error('The "from" parameter is required and must be an object with "email".');
            }
            if (empty($to) || !is_array($to)) {
                return ToolResult::error('The "to" parameter is required and must be an array of recipient objects.');
            }
            if (empty($subject)) {
                return ToolResult::error('The "subject" parameter is required.');
            }

            $data = [
                'from' => $from,
                'to' => $to,
                'subject' => $subject,
            ];

            if (isset($args['text'])) {
                $data['text'] = $args['text'];
            }
            if (isset($args['html'])) {
                $data['html'] = $args['html'];
            }
            if (isset($args['inbox_id'])) {
                $data['inbox_id'] = (int) $args['inbox_id'];
            }

            $result = $this->service->sendTestEmail($data);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
