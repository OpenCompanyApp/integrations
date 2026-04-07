<?php

namespace OpenCompany\Integrations\Pingdom\Tools;

use OpenCompany\Integrations\Pingdom\PingdomService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class PingdomGetCheck implements Tool
{
    public function __construct(
        private PingdomService $service,
    ) {}

    public function name(): string
    {
        return 'pingdom_get_check';
    }

    public function description(): string
    {
        return 'Get detailed information about a specific Pingdom uptime check, including configuration, current status, and last test results.';
    }

    public function parameters(): array
    {
        return [
            'check_id' => ['type' => 'integer', 'required' => true, 'description' => 'The ID of the check to retrieve.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Pingdom integration is not configured.');
            }

            $checkId = (int) $args['check_id'];
            $result = $this->service->getCheck($checkId);

            $check = $result['check'] ?? $result;

            return ToolResult::success($check);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
