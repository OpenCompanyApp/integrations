<?php

namespace OpenCompany\Integrations\ClickSend\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\ClickSend\ClickSendService;

/**
 * Send one or more SMS messages via ClickSend.
 *
 * Accepts an array of message objects each containing a recipient
 * phone number, message body, and optional sender ID.
 */
class ClickSendSendSms implements Tool
{
    /**
     * @param  ClickSendService  $service  The ClickSend API client
     */
    public function __construct(
        private ClickSendService $service,
    ) {}

    public function name(): string
    {
        return 'clicksend_send_sms';
    }

    public function description(): string
    {
        return 'Send one or more SMS messages via ClickSend. Each message requires a "to" phone number and "body" text.';
    }

    public function parameters(): array
    {
        return [
            'messages' => [
                'type' => 'array',
                'required' => true,
                'description' => 'Array of message objects. Each object must have "to" (phone number) and "body" (text). Optional: "from" (sender ID).',
            ],
        ];
    }

    /**
     * Send SMS messages via ClickSend.
     *
     * @param  array<string, mixed>  $args  Tool arguments containing 'messages' array
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('ClickSend integration is not configured.');
            }

            $messages = $args['messages'] ?? [];

            if (empty($messages)) {
                return ToolResult::error('messages is required and must be a non-empty array.');
            }

            $result = $this->service->sendSms($messages);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
