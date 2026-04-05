<?php

namespace OpenCompany\Integrations\Twilio\Tools;

use OpenCompany\Integrations\Twilio\TwilioService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Lookup phone number details using the Twilio Lookup API v2.
 *
 * Uses a different base URL (lookups.twilio.com) and supports requesting
 * additional fields like caller name, line type, and carrier info.
 */
class TwilioLookupPhone implements Tool
{
    /**
     * @param  TwilioService  $service  The Twilio API client
     */
    public function __construct(
        private TwilioService $service,
    ) {}

    public function name(): string
    {
        return 'twilio_lookup_phone';
    }

    public function description(): string
    {
        return <<<'MD'
        Lookup phone number details using the Twilio Lookup API v2.
        Provide a phone number in E.164 format. Optionally request additional fields
        like "caller_name", "line_type_intelligence", "sim_swap", or "call_forwarding".
        MD;
    }

    public function parameters(): array
    {
        return [
            'phone_number' => ['type' => 'string', 'required' => true, 'description' => 'Phone number in E.164 format (e.g., "+15551234567").'],
            'fields' => ['type' => 'string', 'description' => 'Comma-separated list of additional fields to request (e.g., "line_type_intelligence,caller_name").'],
        ];
    }

    /**
     * Lookup phone number details using the Twilio Lookup API.
     *
     * @param  array<string, mixed>  $args  Tool arguments (phone_number, fields)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Twilio integration is not configured.');
            }

            $phoneNumber = $args['phone_number'] ?? '';
            if (empty($phoneNumber)) {
                return ToolResult::error('phone_number is required.');
            }

            $params = [];

            if (! empty($args['fields'])) {
                $params['Fields'] = $args['fields'];
            }

            $result = $this->service->lookupPhone($phoneNumber, $params);

            return ToolResult::success([
                'phone_number' => $result['phone_number'] ?? '',
                'national_format' => $result['national_format'] ?? '',
                'country_code' => $result['country_code'] ?? '',
                'calling_country_code' => $result['calling_country_code'] ?? '',
                'valid' => $result['valid'] ?? null,
                'validation_errors' => $result['validation_errors'] ?? [],
                'caller_name' => $result['caller_name'] ?? null,
                'line_type_intelligence' => $result['line_type_intelligence'] ?? null,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
