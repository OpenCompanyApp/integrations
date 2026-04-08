<?php

namespace OpenCompany\Integrations\LambdaLabs\Tools;

use OpenCompany\Integrations\LambdaLabs\LambdaLabsService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class LambdaLabsGetCurrentUser implements Tool
{
    public function __construct(
        private LambdaLabsService $service,
    ) {}

    public function name(): string
    {
        return 'lambda_labs_get_current_user';
    }

    public function description(): string
    {
        return 'Get information about the current authenticated Lambda Labs user, including email, user ID, and account status.';
    }

    public function parameters(): array
    {
        return [];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Lambda Labs integration is not configured.');
            }

            $result = $this->service->getCurrentUser();

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
