<?php

namespace OpenCompany\Integrations\Typefully\Tools;

use OpenCompany\Integrations\Typefully\TypefullyService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class TypefullyGetCurrentUser implements Tool
{
    public function __construct(
        private TypefullyService $service,
    ) {}

    public function name(): string
    {
        return 'typefully_get_current_user';
    }

    public function description(): string
    {
        return 'Get the authenticated Typefully user\'s profile information, including handle, name, and account details.';
    }

    public function parameters(): array
    {
        return [];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Typefully integration is not configured.');
            }

            $result = $this->service->getCurrentUser();

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
