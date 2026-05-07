<?php

namespace OpenCompany\Integrations\MessageBird\Tools;

use OpenCompany\Integrations\MessageBird\MessageBirdService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Send an SMS message through MessageBird.
 *
 * Supports the core SMS endpoint with optional advanced parameters.
 */
class MessageBirdSendSms implements Tool
{
    /**
     * @param  MessageBirdService  $service  The MessageBird REST API client
     */
    public function __construct(
        private MessageBirdService $service,
    ) {}

    public function name(): string
    {
        return 'messagebird_send_sms';
    }

    public function description(): string
    {
        return 'Send an SMS message to one or more recipients via MessageBird. Specify a sender (originator), one or more phone numbers, and the message body.';
    }

    public function parameters(): array
    {
        return [
            'originator' => ['type' => 'string', 'required' => true, 'description' => 'Sender name or phone number (e.g., "OpenCompany" or "+3197012345678"). Max 11 characters for alphanumeric, or a valid phone number.'],
            'recipients' => ['type' => 'array', 'required' => true, 'description' => 'Array of recipient phone numbers in international format (e.g., ["+31612345678", "+447912345678"]).'],
            'body' => ['type' => 'string', 'required' => true, 'description' => 'The SMS text message body. Max 160 characters for a single SMS; longer messages are concatenated and charged accordingly.'],
            'options' => ['type' => 'object', 'description' => 'Optional MessageBird SMS parameters such as reference, scheduledDatetime, type, datacoding, validity, reportUrl.'],
        ];
    }

    /**
     * Send an SMS message.
     *
     * @param  array<string, mixed>  $args  Tool arguments
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('MessageBird integration is not configured.');
            }

            $originator = $args['originator'];
            $recipients = $args['recipients'];
            $body = $args['body'];

            if (empty($recipients) || !is_array($recipients)) {
                return ToolResult::error('At least one recipient phone number is required.');
            }

            if (empty($body)) {
                return ToolResult::error('Message body cannot be empty.');
            }

            $result = $this->service->sendSms($originator, $recipients, $body, $args['options'] ?? []);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
