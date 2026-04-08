<?php

namespace OpenCompany\Integrations\GoogleGemini\Tools;

use OpenCompany\Integrations\GoogleGemini\GeminiService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class GeminiGetCurrentUser implements Tool
{
    public function __construct(
        private GeminiService $service,
    ) {}

    public function name(): string
    {
        return 'gemini_get_current_user';
    }

    public function description(): string
    {
        return 'Get information about the currently authenticated Google user, including permissions and account details.';
    }

    public function parameters(): array
    {
        return [];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Google Gemini integration is not configured.');
            }

            $result = $this->service->getCurrentUser();

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
