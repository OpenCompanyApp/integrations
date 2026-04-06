<?php

namespace OpenCompany\Integrations\GoogleGemini\Tools;

use OpenCompany\Integrations\GoogleGemini\GeminiService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class GeminiGetModel implements Tool
{
    public function __construct(
        private GeminiService $service,
    ) {}

    public function name(): string
    {
        return 'gemini_get_model';
    }

    public function description(): string
    {
        return 'Get detailed information about a specific Gemini model, including supported generation methods, input/output token limits, and capabilities.';
    }

    public function parameters(): array
    {
        return [
            'id' => ['type' => 'string', 'required' => true, 'description' => 'The model resource name (e.g., "models/gemini-2.0-flash" or "models/gemini-pro").'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Google Gemini integration is not configured.');
            }

            if (empty($args['id'])) {
                return ToolResult::error('Model id is required.');
            }

            $result = $this->service->getModel($args['id']);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
