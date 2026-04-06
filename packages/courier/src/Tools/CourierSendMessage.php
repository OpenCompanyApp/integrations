<?php

namespace OpenCompany\Integrations\Courier\Tools;

use OpenCompany\Integrations\Courier\CourierService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class CourierSendMessage implements Tool
{
    public function __construct(
        private CourierService $service,
    ) {}

    public function name(): string
    {
        return 'courier_send_message';
    }

    public function description(): string
    {
        return 'Send a notification message through Courier. Provide a message payload with content or template, and a recipient (user ID, email, or recipient object). Supports all Courier send options including channels, routing, and preferences.';
    }

    public function parameters(): array
    {
        return [
            'message' => ['type' => 'object', 'required' => true, 'description' => 'The message payload. Can include "template" (template ID), "content" (title/body blocks), "routing" (channel overrides), "data" (template variables), and other Courier send options. Pass as a JSON object.'],
            'recipient' => ['type' => 'string', 'required' => true, 'description' => 'The message recipient. Can be a Courier user ID, email address, or a JSON object with recipient details (e.g., {"email": "user@example.com"}).'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Courier integration is not configured.');
            }

            $message = $args['message'] ?? [];
            $recipient = $args['recipient'] ?? null;

            if (is_string($message)) {
                $message = json_decode($message, true) ?? [];
            }

            if (empty($message)) {
                return ToolResult::error('Message payload is required.');
            }

            if (empty($recipient)) {
                return ToolResult::error('Recipient is required.');
            }

            // If recipient is a JSON string, decode it
            if (is_string($recipient) && (str_starts_with($recipient, '{') || str_starts_with($recipient, '['))) {
                $decoded = json_decode($recipient, true);
                if ($decoded !== null) {
                    $recipient = $decoded;
                }
            }

            $result = $this->service->sendMessage($message, $recipient);

            return ToolResult::success([
                'message' => 'Message sent successfully.',
                'request_id' => $result['requestId'] ?? $result['request_id'] ?? null,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
