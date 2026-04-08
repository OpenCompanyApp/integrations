<?php

namespace OpenCompany\Integrations\Groq\Tools;

use OpenCompany\Integrations\Groq\GroqService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class GroqListModels implements Tool
{
    public function __construct(
        private GroqService $service,
    ) {}

    public function name(): string
    {
        return 'groq_list_models';
    }

    public function description(): string
    {
        return 'List available Groq AI models. Returns model IDs, ownership, and other metadata for models accessible via the Groq API.';
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

            $result = $this->service->listModels();

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
