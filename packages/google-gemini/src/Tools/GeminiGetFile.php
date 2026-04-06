<?php

namespace OpenCompany\Integrations\GoogleGemini\Tools;

use OpenCompany\Integrations\GoogleGemini\GeminiService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class GeminiGetFile implements Tool
{
    public function __construct(
        private GeminiService $service,
    ) {}

    public function name(): string
    {
        return 'gemini_get_file';
    }

    public function description(): string
    {
        return 'Get metadata for an uploaded file in the Gemini File API, including its name, display name, MIME type, size, and processing state.';
    }

    public function parameters(): array
    {
        return [
            'id' => ['type' => 'string', 'required' => true, 'description' => 'The file resource name (e.g., "files/abc123").'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Google Gemini integration is not configured.');
            }

            if (empty($args['id'])) {
                return ToolResult::error('File id is required.');
            }

            $result = $this->service->getFile($args['id']);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
