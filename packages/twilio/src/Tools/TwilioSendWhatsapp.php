<?php

namespace OpenCompany\Integrations\Twilio\Tools;

use OpenCompany\Integrations\Twilio\TwilioService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Send a WhatsApp message via Twilio.
 *
 * Automatically prefixes "from" and "to" numbers with "whatsapp:" as required
 * by the Twilio WhatsApp API.
 */
class TwilioSendWhatsapp implements Tool
{
    /**
     * @param  TwilioService  $service  The Twilio API client
     */
    public function __construct(
        private TwilioService $service,
    ) {}

    public function name(): string
    {
        return 'twilio_send_whatsapp';
    }

    public function description(): string
    {
        return <<<'MD'
        Send a WhatsApp message via Twilio.
        Provide "to" and "from" phone numbers in E.164 format — they will automatically be prefixed with "whatsapp:".
        Supports text and media messages.
        MD;
    }

    public function parameters(): array
    {
        return [
            'to' => ['type' => 'string', 'required' => true, 'description' => 'Destination phone number in E.164 format (e.g., "+15551234567").'],
            'from' => ['type' => 'string', 'required' => true, 'description' => 'Twilio WhatsApp-enabled phone number in E.164 format.'],
            'body' => ['type' => 'string', 'required' => true, 'description' => 'Text body of the WhatsApp message.'],
            'media_url' => ['type' => 'string', 'description' => 'URL of media to include (image, audio, video, or document).'],
        ];
    }

    /**
     * Send a WhatsApp message via Twilio.
     *
     * @param  array<string, mixed>  $args  Tool arguments (to, from, body, media_url)
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

            // Prefix with "whatsapp:" as required by Twilio WhatsApp API
            $data = [
                'To' => 'whatsapp:' . $to,
                'From' => 'whatsapp:' . $from,
                'Body' => $body,
            ];

            if (! empty($args['media_url'])) {
                $data['MediaUrl'] = $args['media_url'];
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
