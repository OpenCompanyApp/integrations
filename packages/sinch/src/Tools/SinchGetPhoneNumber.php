<?php

namespace OpenCompany\Integrations\Sinch\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Sinch\SinchService;

/**
 * Get details for a specific phone number from Sinch.
 *
 * Returns information about a rented phone number including
 * its status, capabilities, and configuration.
 */
class SinchGetPhoneNumber implements Tool
{
    /**
     * @param  SinchService  $service  The Sinch API client
     */
    public function __construct(
        private SinchService $service,
    ) {}

    public function name(): string
    {
        return 'sinch_get_phone_number';
    }

    public function description(): string
    {
        return 'Get details for a specific phone number in your Sinch account.';
    }

    public function parameters(): array
    {
        return [
            'phone_number' => [
                'type' => 'string',
                'required' => true,
                'description' => 'The phone number to look up (E.164 format, e.g. "+1234567890").',
            ],
        ];
    }

    /**
     * Get a phone number from Sinch.
     *
     * @param  array<string, mixed>  $args  Tool arguments
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Sinch integration is not configured.');
            }

            $phoneNumber = $args['phone_number'] ?? '';

            if (empty($phoneNumber)) {
                return ToolResult::error('phone_number is required.');
            }

            $result = $this->service->getPhoneNumber($phoneNumber);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
