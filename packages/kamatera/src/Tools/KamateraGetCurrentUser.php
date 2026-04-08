<?php

namespace OpenCompany\Integrations\Kamatera\Tools;

use OpenCompany\Integrations\Kamatera\KamateraService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class KamateraGetCurrentUser implements Tool
{
    public function __construct(
        private KamateraService $service,
    ) {}

    public function name(): string
    {
        return 'kamatera_get_current_user';
    }

    public function description(): string
    {
        return 'Get information about the current authenticated Kamatera account, including email, name, and account details.';
    }

    public function parameters(): array
    {
        return [];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Kamatera integration is not configured.');
            }

            $result = $this->service->getCurrentUser();

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
