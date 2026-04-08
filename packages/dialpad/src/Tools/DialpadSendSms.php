<?php

namespace OpenCompany\Integrations\Dialpad\Tools;

use OpenCompany\Integrations\Dialpad\DialpadService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Send an SMS message via Dialpad.
 */
class DialpadSendSms implements Tool
{
    public function __construct(
        private DialpadService $service,
    ) {}

    public function name(): string
    {
        return 'dialpad_send_sms';
    }

    public function description(): string
    {
        return 'Send an SMS message via Dialpad. Specify the recipient number, sender number (or department ID), and message text.';
    }

    public function parameters(): array
    {
        return [
            'to' => ['type' => 'string', 'required' => true, 'description' => 'The recipient phone number in E.164 format (e.g., "+14155551234").'],
            'from' => ['type' => 'string', 'required' => true, 'description' => 'The sender phone number or department ID in E.164 format (e.g., "+14155559876").'],
            'text' => ['type' => 'string', 'required' => true, 'description' => 'The SMS message body.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Dialpad integration is not configured.');
            }

            if (empty($args['to'])) {
                return ToolResult::error('Recipient phone number ("to") is required.');
            }
            if (empty($args['from'])) {
                return ToolResult::error('Sender phone number ("from") is required.');
            }
            if (empty($args['text'])) {
                return ToolResult::error('Message text is required.');
            }

            $result = $this->service->sendSms(
                to: $args['to'],
                from: $args['from'],
                text: $args['text'],
            );

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
