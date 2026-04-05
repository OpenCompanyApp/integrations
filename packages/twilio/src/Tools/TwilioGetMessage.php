<?php

namespace OpenCompany\Integrations\Twilio\Tools;

use OpenCompany\Integrations\Twilio\TwilioService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Retrieve a Twilio message by its SID.
 *
 * Returns the full message details including status, body, timestamps, and pricing.
 */
class TwilioGetMessage implements Tool
{
    /**
     * @param  TwilioService  $service  The Twilio API client
     */
    public function __construct(
        private TwilioService $service,
    ) {}

    public function name(): string
    {
        return 'twilio_get_message';
    }

    public function description(): string
    {
        return <<<'MD'
        Retrieve a Twilio message by its SID.
        Returns the full message details including status, body, timestamps, and pricing.
        MD;
    }

    public function parameters(): array
    {
        return [
            'message_sid' => ['type' => 'string', 'required' => true, 'description' => 'Message SID (e.g., "SMxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx").'],
        ];
    }

    /**
     * Retrieve a Twilio message by SID.
     *
     * @param  array<string, mixed>  $args  Tool arguments (message_sid)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Twilio integration is not configured.');
            }

            $messageSid = $args['message_sid'] ?? '';
            if (empty($messageSid)) {
                return ToolResult::error('message_sid is required.');
            }

            $result = $this->service->getMessage($messageSid);

            return ToolResult::success([
                'sid' => $result['sid'] ?? '',
                'to' => $result['to'] ?? '',
                'from' => $result['from'] ?? '',
                'body' => $result['body'] ?? '',
                'status' => $result['status'] ?? '',
                'direction' => $result['direction'] ?? '',
                'date_created' => $result['date_created'] ?? null,
                'date_sent' => $result['date_sent'] ?? null,
                'date_updated' => $result['date_updated'] ?? null,
                'price' => $result['price'] ?? null,
                'price_unit' => $result['price_unit'] ?? null,
                'error_code' => $result['error_code'] ?? null,
                'error_message' => $result['error_message'] ?? null,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
