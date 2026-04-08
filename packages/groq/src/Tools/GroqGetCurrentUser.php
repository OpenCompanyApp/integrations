<?php

namespace OpenCompany\Integrations\Groq\Tools;

use OpenCompany\Integrations\Groq\GroqService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class GroqGetCurrentUser implements Tool
{
    public function __construct(
        private GroqService $service,
    ) {}

    public function name(): string
    {
        return 'groq_get_current_user';
    }

    public function description(): string
    {
        return 'Get information about the currently authenticated Groq user, including user ID, email, and organization details.';
    }

    public function parameters(): array
    {
        return [];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Groq integration is not configured.');
            }

            $result = $this->service->getCurrentUser();

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
