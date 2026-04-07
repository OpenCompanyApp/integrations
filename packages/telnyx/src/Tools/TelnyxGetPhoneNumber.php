<?php

namespace OpenCompany\Integrations\Telnyx\Tools;

use OpenCompany\Integrations\Telnyx\TelnyxService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get details for a specific phone number on the Telnyx account.
 *
 * Returns the phone number ID, E.164 format, connection ID, status, and billing info.
 */
class TelnyxGetPhoneNumber implements Tool
{
    /**
     * @param  TelnyxService  $service  The Telnyx API client
     */
    public function __construct(
        private TelnyxService $service,
    ) {}

    public function name(): string
    {
        return 'telnyx_get_phone_number';
    }

    public function description(): string
    {
        return 'Get details for a specific phone number by its ID. Returns the number, status, connection, and billing information.';
    }

    public function parameters(): array
    {
        return [
            'phone_number_id' => ['type' => 'string', 'required' => true, 'description' => 'The Telnyx phone number ID (e.g., "1293384265029123456").'],
        ];
    }

    /**
     * Get details for a specific phone number.
     *
     * @param  array<string, mixed>  $args  Tool arguments (phone_number_id)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Telnyx integration is not configured.');
            }

            $phoneNumberId = $args['phone_number_id'] ?? '';

            if (empty($phoneNumberId)) {
                return ToolResult::error('phone_number_id is required.');
            }

            $result = $this->service->getPhoneNumber($phoneNumberId);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
