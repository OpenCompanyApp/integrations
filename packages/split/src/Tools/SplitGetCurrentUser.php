<?php

namespace OpenCompany\Integrations\Split\Tools;

use OpenCompany\Integrations\Split\SplitService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class SplitGetCurrentUser implements Tool
{
    public function __construct(
        private SplitService $service,
    ) {}

    public function name(): string
    {
        return 'split_get_current_user';
    }

    public function description(): string
    {
        return 'Get information about the currently authenticated Split user. Useful for verifying API credentials.';
    }

    public function parameters(): array
    {
        return [];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Split integration is not configured.');
            }

            $result = $this->service->getCurrentUser();

            return ToolResult::success([
                'id' => $result['id'] ?? null,
                'email' => $result['email'] ?? '',
                'name' => $result['name'] ?? '',
                'type' => $result['type'] ?? '',
                'status' => $result['status'] ?? '',
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
