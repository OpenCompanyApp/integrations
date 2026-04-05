<?php

namespace OpenCompany\Integrations\Twilio\Tools;

use OpenCompany\Integrations\Twilio\TwilioService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Send an SMS or MMS message via Twilio.
 *
 * Supports text and media messages with optional status callback URL.
 */
class TwilioSendSms implements Tool
{
    /**
     * @param  TwilioService  $service  The Twilio API client
     */
    public function __construct(
        private TwilioService $service,
    ) {}

    public function name(): string
    {
        return 'twilio_send_sms';
    }

    public function description(): string
    {
        return <<<'MD'
        Send an SMS or MMS message via Twilio.
        Provide "to" and "from" phone numbers in E.164 format (e.g., "+15551234567").
        Optionally include media_url for MMS and status_callback for delivery tracking.
        MD;
    }

    public function parameters(): array
    {
        return [
            'to' => ['type' => 'string', 'required' => true, 'description' => 'Destination phone number in E.164 format.'],
            'from' => ['type' => 'string', 'required' => true, 'description' => 'Twilio phone number to send from in E.164 format.'],
            'body' => ['type' => 'string', 'required' => true, 'description' => 'Text body of the message (max 1600 characters).'],
            'media_url' => ['type' => 'string', 'description' => 'URL of media to include (for MMS).'],
            'status_callback' => ['type' => 'string', 'description' => 'URL Twilio will call with status updates.'],
        ];
    }

    /**
     * Send an SMS or MMS message via Twilio.
     *
     * @param  array<string, mixed>  $args  Tool arguments (to, from, body, media_url, status_callback)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Twilio integration is not configured.');
            }

            $to = $args['to'] ?? '';
            $from = $args['from'] ?? '';
            $body = $args['body'] ?? '';

            if (empty($to)) {
                return ToolResult::error('to is required.');
            }
            if (empty($from)) {
                return ToolResult::error('from is required.');
            }
            if (empty($body)) {
                return ToolResult::error('body is required.');
            }

            $data = [
                'To' => $to,
                'From' => $from,
                'Body' => $body,
            ];

            if (! empty($args['media_url'])) {
                $data['MediaUrl'] = $args['media_url'];
            }
            if (! empty($args['status_callback'])) {
                $data['StatusCallback'] = $args['status_callback'];
            }

            $result = $this->service->sendMessage($data);

            return ToolResult::success([
                'sid' => $result['sid'] ?? '',
                'to' => $result['to'] ?? '',
                'from' => $result['from'] ?? '',
                'body' => $result['body'] ?? '',
                'status' => $result['status'] ?? '',
                'date_created' => $result['date_created'] ?? null,
                'price' => $result['price'] ?? null,
                'price_unit' => $result['price_unit'] ?? null,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
