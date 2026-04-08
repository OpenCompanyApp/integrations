<?php

namespace OpenCompany\Integrations\Telnyx\Tools;

use OpenCompany\Integrations\Telnyx\TelnyxService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Send an SMS or MMS message via the Telnyx Messaging API.
 *
 * Supports text SMS and media URLs for MMS messages.
 */
class TelnyxSendSms implements Tool
{
    /**
     * @param  TelnyxService  $service  The Telnyx API client
     */
    public function __construct(
        private TelnyxService $service,
    ) {}

    public function name(): string
    {
        return 'telnyx_send_sms';
    }

    public function description(): string
    {
        return 'Send an SMS or MMS message via Telnyx. Provide a sender phone number (from your Telnyx account), a destination number, and the message body.';
    }

    public function parameters(): array
    {
        return [
            'from' => ['type' => 'string', 'required' => true, 'description' => 'Sender phone number in E.164 format (e.g., "+12345678900"). Must be a number on your Telnyx account.'],
            'to' => ['type' => 'string', 'required' => true, 'description' => 'Destination phone number in E.164 format (e.g., "+19876543210").'],
            'text' => ['type' => 'string', 'required' => true, 'description' => 'The text body of the message.'],
            'subject' => ['type' => 'string', 'description' => 'Subject line (for MMS messages).'],
            'media_urls' => ['type' => 'array', 'description' => 'Array of media URLs to include as MMS attachments.', 'items' => ['type' => 'string']],
            'use_mms' => ['type' => 'boolean', 'description' => 'Set to true to send as MMS. Defaults to false (SMS).'],
        ];
    }

    /**
     * Send an SMS or MMS message.
     *
     * @param  array<string, mixed>  $args  Tool arguments (from, to, text, subject, media_urls, use_mms)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Telnyx integration is not configured.');
            }

            $from = $args['from'] ?? '';
            $to = $args['to'] ?? '';
            $text = $args['text'] ?? '';

            if (empty($from)) {
                return ToolResult::error('from (sender phone number) is required.');
            }
            if (empty($to)) {
                return ToolResult::error('to (destination phone number) is required.');
            }
            if (empty($text)) {
                return ToolResult::error('text (message body) is required.');
            }

            $payload = [
                'from' => $from,
                'to' => $to,
                'text' => $text,
            ];

            if (isset($args['subject'])) {
                $payload['subject'] = $args['subject'];
            }
            if (!empty($args['media_urls'])) {
                $payload['media_urls'] = $args['media_urls'];
            }
            if (!empty($args['use_mms'])) {
                $payload['use_mms'] = true;
            }

            $result = $this->service->sendSms($payload);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
