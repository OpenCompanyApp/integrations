<?php

namespace OpenCompany\Integrations\Twilio\Tools;

use OpenCompany\Integrations\Twilio\TwilioService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Retrieve Twilio account details.
 *
 * Returns account status, type, friendly name, and other account-level information.
 */
class TwilioGetAccount implements Tool
{
    /**
     * @param  TwilioService  $service  The Twilio API client
     */
    public function __construct(
        private TwilioService $service,
    ) {}

    public function name(): string
    {
        return 'twilio_get_account';
    }

    public function description(): string
    {
        return <<<'MD'
        Retrieve Twilio account details.
        Optionally provide an account SID to look up a specific subaccount,
        or omit to retrieve the current account.
        MD;
    }

    public function parameters(): array
    {
        return [
            'sid' => ['type' => 'string', 'description' => 'Account SID to look up, or omit for the current account.'],
        ];
    }

    /**
     * Retrieve Twilio account details.
     *
     * @param  array<string, mixed>  $args  Tool arguments (sid)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Twilio integration is not configured.');
            }

            $sid = $args['sid'] ?? null;

            $result = $this->service->getAccount($sid);

            return ToolResult::success([
                'sid' => $result['sid'] ?? '',
                'friendly_name' => $result['friendly_name'] ?? '',
                'status' => $result['status'] ?? '',
                'type' => $result['type'] ?? '',
                'date_created' => $result['date_created'] ?? null,
                'date_updated' => $result['date_updated'] ?? null,
                'owner_account_sid' => $result['owner_account_sid'] ?? null,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
