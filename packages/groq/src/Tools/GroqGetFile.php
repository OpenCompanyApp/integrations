<?php

namespace OpenCompany\Integrations\Groq\Tools;

use OpenCompany\Integrations\Groq\GroqService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class GroqGetFile implements Tool
{
    public function __construct(
        private GroqService $service,
    ) {}

    public function name(): string
    {
        return 'groq_get_file';
    }

    public function description(): string
    {
        return 'Get metadata for an uploaded file in Groq, including its ID, filename, purpose, size in bytes, and processing status.';
    }

    public function parameters(): array
    {
        return [
            'file_id' => ['type' => 'string', 'required' => true, 'description' => 'The file identifier (e.g., "file-abc123").'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Groq integration is not configured.');
            }

            if (empty($args['file_id'])) {
                return ToolResult::error('File ID is required.');
            }

            $result = $this->service->getFile($args['file_id']);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
