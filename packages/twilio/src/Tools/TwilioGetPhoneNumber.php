<?php

namespace OpenCompany\Integrations\Twilio\Tools;

use OpenCompany\Integrations\Twilio\TwilioService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Retrieve a Twilio phone number by its SID.
 *
 * Returns phone number details including capabilities and configuration.
 */
class TwilioGetPhoneNumber implements Tool
{
    /**
     * @param  TwilioService  $service  The Twilio API client
     */
    public function __construct(
        private TwilioService $service,
    ) {}

    public function name(): string
    {
        return 'twilio_get_phone_number';
    }

    public function description(): string
    {
        return <<<'MD'
        Retrieve a Twilio incoming phone number by its SID.
        Returns phone number details including capabilities and configuration.
        MD;
    }

    public function parameters(): array
    {
        return [
            'phone_sid' => ['type' => 'string', 'required' => true, 'description' => 'Phone number SID (e.g., "PNxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx").'],
        ];
    }

    /**
     * Retrieve a Twilio phone number by SID.
     *
     * @param  array<string, mixed>  $args  Tool arguments (phone_sid)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Twilio integration is not configured.');
            }

            $phoneSid = $args['phone_sid'] ?? '';
            if (empty($phoneSid)) {
                return ToolResult::error('phone_sid is required.');
            }

            $result = $this->service->getPhoneNumber($phoneSid);

            return ToolResult::success([
                'sid' => $result['sid'] ?? '',
                'phone_number' => $result['phone_number'] ?? '',
                'friendly_name' => $result['friendly_name'] ?? '',
                'capabilities' => $result['capabilities'] ?? [],
                'date_created' => $result['date_created'] ?? null,
                'date_updated' => $result['date_updated'] ?? null,
                'voice_url' => $result['voice_url'] ?? null,
                'sms_url' => $result['sms_url'] ?? null,
                'status_callback' => $result['status_callback'] ?? null,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
