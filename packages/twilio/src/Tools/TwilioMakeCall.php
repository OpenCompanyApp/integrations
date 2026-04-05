<?php

namespace OpenCompany\Integrations\Twilio\Tools;

use OpenCompany\Integrations\Twilio\TwilioService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Make an outbound voice call via Twilio.
 *
 * Requires either a TwiML URL or inline TwiML to instruct the call.
 */
class TwilioMakeCall implements Tool
{
    /**
     * @param  TwilioService  $service  The Twilio API client
     */
    public function __construct(
        private TwilioService $service,
    ) {}

    public function name(): string
    {
        return 'twilio_make_call';
    }

    public function description(): string
    {
        return <<<'MD'
        Make an outbound voice call via Twilio.
        Provide a "url" that returns TwiML, or inline "twiml" to control the call.
        Optionally provide a status_callback URL for call progress events.
        MD;
    }

    public function parameters(): array
    {
        return [
            'to' => ['type' => 'string', 'required' => true, 'description' => 'Destination phone number in E.164 format.'],
            'from' => ['type' => 'string', 'required' => true, 'description' => 'Twilio phone number to call from in E.164 format.'],
            'url' => ['type' => 'string', 'description' => 'URL that returns TwiML instructions for the call.'],
            'twiml' => ['type' => 'string', 'description' => 'Inline TwiML to execute when the call connects.'],
            'status_callback' => ['type' => 'string', 'description' => 'URL Twilio will call with status updates.'],
        ];
    }

    /**
     * Make an outbound voice call via Twilio.
     *
     * @param  array<string, mixed>  $args  Tool arguments (to, from, url, twiml, status_callback)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Twilio integration is not configured.');
            }

            $to = $args['to'] ?? '';
            $from = $args['from'] ?? '';

            if (empty($to)) {
                return ToolResult::error('to is required.');
            }
            if (empty($from)) {
                return ToolResult::error('from is required.');
            }
            if (empty($args['url']) && empty($args['twiml'])) {
                return ToolResult::error('Either url or twiml is required.');
            }

            $data = [
                'To' => $to,
                'From' => $from,
            ];

            if (! empty($args['url'])) {
                $data['Url'] = $args['url'];
            }
            if (! empty($args['twiml'])) {
                $data['Twiml'] = $args['twiml'];
            }
            if (! empty($args['status_callback'])) {
                $data['StatusCallback'] = $args['status_callback'];
            }

            $result = $this->service->makeCall($data);

            return ToolResult::success([
                'sid' => $result['sid'] ?? '',
                'to' => $result['to'] ?? '',
                'from' => $result['from'] ?? '',
                'status' => $result['status'] ?? '',
                'direction' => $result['direction'] ?? '',
                'date_created' => $result['date_created'] ?? null,
                'duration' => $result['duration'] ?? null,
                'price' => $result['price'] ?? null,
                'price_unit' => $result['price_unit'] ?? null,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
