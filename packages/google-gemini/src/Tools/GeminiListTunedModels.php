<?php

namespace OpenCompany\Integrations\GoogleGemini\Tools;

use OpenCompany\Integrations\GoogleGemini\GeminiService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class GeminiListTunedModels implements Tool
{
    public function __construct(
        private GeminiService $service,
    ) {}

    public function name(): string
    {
        return 'gemini_list_tuned_models';
    }

    public function description(): string
    {
        return 'List tuned (fine-tuned) Gemini models in your project. Returns model names, base models, tuning tasks, and display names.';
    }

    public function parameters(): array
    {
        return [
            'pageSize' => ['type' => 'integer', 'description' => 'Maximum number of tuned models to return per page (default: 50, max: 100).'],
            'pageToken' => ['type' => 'string', 'description' => 'Token from a previous response to fetch the next page of results.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Google Gemini integration is not configured.');
            }

            $pageSize = isset($args['pageSize']) ? (int) $args['pageSize'] : 50;
            $pageToken = $args['pageToken'] ?? null;

            $result = $this->service->listTunedModels($pageSize, $pageToken);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
