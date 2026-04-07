<?php

namespace OpenCompany\Integrations\Scaleway\Tools;

use OpenCompany\Integrations\Scaleway\ScalewayService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class ScalewayGetCurrentUser implements Tool
{
    public function __construct(
        private ScalewayService $service,
    ) {}

    public function name(): string
    {
        return 'scaleway_get_current_user';
    }

    public function description(): string
    {
        return 'Get information about the current authenticated Scaleway account, including email, organization, and status.';
    }

    public function parameters(): array
    {
        return [];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Scaleway integration is not configured.');
            }

            $result = $this->service->getCurrentUser();

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
