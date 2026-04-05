<?php

namespace OpenCompany\Integrations\Lob\Tools;

use OpenCompany\Integrations\Lob\LobService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class LobVerifyAddress implements Tool
{
    public function __construct(
        private LobService $service,
    ) {}

    public function name(): string
    {
        return 'lob_verify_address';
    }

    public function description(): string
    {
        return 'Verify a US mailing address. Returns deliverability status, the normalized address, and details about the components (street, ZIP+4, etc.).';
    }

    public function parameters(): array
    {
        return [
            'address' => ['type' => 'string', 'required' => true, 'description' => 'Primary address line (street number and name, e.g., "123 Main St" or "123 Main St Apt 4B").'],
            'city' => ['type' => 'string', 'required' => true, 'description' => 'City name (e.g., "San Francisco").'],
            'state' => ['type' => 'string', 'required' => true, 'description' => 'Two-letter state code (e.g., "CA", "NY").'],
            'zip' => ['type' => 'string', 'required' => true, 'description' => 'ZIP code — 5 digits or ZIP+4 (e.g., "94107" or "94107-1234").'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Lob integration is not configured.');
            }

            $result = $this->service->verifyAddress(
                address: $args['address'],
                city: $args['city'],
                state: $args['state'],
                zip: $args['zip'],
            );

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
