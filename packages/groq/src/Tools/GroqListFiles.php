<?php

namespace OpenCompany\Integrations\Groq\Tools;

use OpenCompany\Integrations\Groq\GroqService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class GroqListFiles implements Tool
{
    public function __construct(
        private GroqService $service,
    ) {}

    public function name(): string
    {
        return 'groq_list_files';
    }

    public function description(): string
    {
        return 'List files uploaded to the Groq Files API. Returns file IDs, filenames, purposes, sizes, and upload timestamps.';
    }

    public function parameters(): array
    {
        return [
            'purpose' => ['type' => 'string', 'description' => 'Filter files by purpose (e.g., "batch").'],
            'limit' => ['type' => 'integer', 'description' => 'Maximum number of files to return per page (default: 20).'],
            'after' => ['type' => 'string', 'description' => 'Cursor for pagination — file ID to start after.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Groq integration is not configured.');
            }

            $purpose = $args['purpose'] ?? null;
            $limit = isset($args['limit']) ? (int) $args['limit'] : 20;
            $after = $args['after'] ?? null;

            $result = $this->service->listFiles($purpose, $limit, $after);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
