<?php

namespace OpenCompany\Integrations\ClickSend\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\ClickSend\ClickSendService;

/**
 * Send an email message via ClickSend.
 *
 * Supports specifying sender name and address, recipient,
 * subject, and HTML body content.
 */
class ClickSendSendEmail implements Tool
{
    /**
     * @param  ClickSendService  $service  The ClickSend API client
     */
    public function __construct(
        private ClickSendService $service,
    ) {}

    public function name(): string
    {
        return 'clicksend_send_email';
    }

    public function description(): string
    {
        return 'Send an email message via ClickSend. Requires recipient, subject, and body.';
    }

    public function parameters(): array
    {
        return [
            'to' => [
                'type' => 'string',
                'required' => true,
                'description' => 'Recipient email address.',
            ],
            'subject' => [
                'type' => 'string',
                'required' => true,
                'description' => 'Email subject line.',
            ],
            'body' => [
                'type' => 'string',
                'required' => true,
                'description' => 'Email body content (HTML supported).',
            ],
            'from_email_address' => [
                'type' => 'string',
                'description' => 'Sender email address.',
            ],
            'from_name' => [
                'type' => 'string',
                'description' => 'Sender display name.',
            ],
        ];
    }

    /**
     * Send an email via ClickSend.
     *
     * @param  array<string, mixed>  $args  Tool arguments (to, subject, body, from_email_address, from_name)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('ClickSend integration is not configured.');
            }

            $to = $args['to'] ?? '';
            $subject = $args['subject'] ?? '';
            $body = $args['body'] ?? '';

            if (empty($to)) {
                return ToolResult::error('to is required.');
            }
            if (empty($subject)) {
                return ToolResult::error('subject is required.');
            }
            if (empty($body)) {
                return ToolResult::error('body is required.');
            }

            $data = [
                'to' => $to,
                'subject' => $subject,
                'body' => $body,
            ];

            if (isset($args['from_email_address'])) {
                $data['from_email_address'] = $args['from_email_address'];
            }
            if (isset($args['from_name'])) {
                $data['from_name'] = $args['from_name'];
            }

            $result = $this->service->sendEmail($data);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
