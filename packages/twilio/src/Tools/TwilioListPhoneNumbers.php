<?php

namespace OpenCompany\Integrations\Twilio\Tools;

use OpenCompany\Integrations\Twilio\TwilioService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List incoming phone numbers on the Twilio account.
 *
 * Returns all phone numbers associated with the account.
 */
class TwilioListPhoneNumbers implements Tool
{
    /**
     * @param  TwilioService  $service  The Twilio API client
     */
    public function __construct(
        private TwilioService $service,
    ) {}

    public function name(): string
    {
        return 'twilio_list_phone_numbers';
    }

    public function description(): string
    {
        return <<<'MD'
        List incoming phone numbers on the Twilio account.
        Returns all phone numbers associated with the account, including capabilities.
        MD;
    }

    public function parameters(): array
    {
        return [
            'limit' => ['type' => 'integer', 'description' => 'Maximum number of phone numbers to return.'],
        ];
    }

    /**
     * List incoming phone numbers on the Twilio account.
     *
     * @param  array<string, mixed>  $args  Tool arguments (limit)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Twilio integration is not configured.');
            }

            $params = [];

            if (! empty($args['limit'])) {
                $params['PageSize'] = (int) $args['limit'];
            }

            $result = $this->service->listPhoneNumbers($params);

            $phoneNumbers = $result['incoming_phone_numbers'] ?? $result['data'] ?? [];

            $phoneNumbers = array_map(function (array $p) {
                return [
                    'sid' => $p['sid'] ?? '',
                    'phone_number' => $p['phone_number'] ?? '',
                    'friendly_name' => $p['friendly_name'] ?? '',
                    'capabilities' => $p['capabilities'] ?? [],
                    'date_created' => $p['date_created'] ?? null,
                ];
            }, $phoneNumbers);

            return ToolResult::success([
                'phone_numbers' => $phoneNumbers,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
