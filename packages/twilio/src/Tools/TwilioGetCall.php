<?php

namespace OpenCompany\Integrations\Twilio\Tools;

use OpenCompany\Integrations\Twilio\TwilioService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Retrieve a Twilio call by its SID.
 *
 * Returns the full call details including status, duration, timestamps, and pricing.
 */
class TwilioGetCall implements Tool
{
    /**
     * @param  TwilioService  $service  The Twilio API client
     */
    public function __construct(
        private TwilioService $service,
    ) {}

    public function name(): string
    {
        return 'twilio_get_call';
    }

    public function description(): string
    {
        return <<<'MD'
        Retrieve a Twilio call by its SID.
        Returns the full call details including status, duration, timestamps, and pricing.
        MD;
    }

    public function parameters(): array
    {
        return [
            'call_sid' => ['type' => 'string', 'required' => true, 'description' => 'Call SID (e.g., "CAxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx").'],
        ];
    }

    /**
     * Retrieve a Twilio call by SID.
     *
     * @param  array<string, mixed>  $args  Tool arguments (call_sid)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Twilio integration is not configured.');
            }

            $callSid = $args['call_sid'] ?? '';
            if (empty($callSid)) {
                return ToolResult::error('call_sid is required.');
            }

            $result = $this->service->getCall($callSid);

            return ToolResult::success([
                'sid' => $result['sid'] ?? '',
                'to' => $result['to'] ?? '',
                'from' => $result['from'] ?? '',
                'status' => $result['status'] ?? '',
                'direction' => $result['direction'] ?? '',
                'date_created' => $result['date_created'] ?? null,
                'date_updated' => $result['date_updated'] ?? null,
                'duration' => $result['duration'] ?? null,
                'price' => $result['price'] ?? null,
                'price_unit' => $result['price_unit'] ?? null,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
