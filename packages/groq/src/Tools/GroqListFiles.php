<?php

namespace OpenCompany\Integrations\Groq\Tools;

use OpenCompany\Integrations\Groq\GroqService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List files uploaded to Groq.
 */
class GroqListFiles implements Tool
{
    /**
     * @param  GroqService  $service  Groq API client.
     */
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
            'after' => ['type' => 'string', 'description' => 'Cursor for pagination: file ID to start after.'],
        ];
    }

    /**
     * Execute the file listing request.
     *
     * @param  array<string, mixed>  $args  Optional listing filters.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Groq integration is not configured.');
            }

            $query = [];
            foreach (['purpose', 'limit', 'after'] as $key) {
                if (isset($args[$key]) && $args[$key] !== '') {
                    $query[$key] = $key === 'limit' ? (int) $args[$key] : $args[$key];
                }
            }

            $result = $this->service->listFiles($query);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
