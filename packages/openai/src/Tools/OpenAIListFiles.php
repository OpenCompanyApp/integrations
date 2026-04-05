<?php

namespace OpenCompany\Integrations\OpenAI\Tools;

use OpenCompany\Integrations\OpenAI\OpenAIService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List files uploaded to OpenAI.
 *
 * Returns a list of files with optional filtering by purpose
 * and pagination support.
 */
class OpenAIListFiles implements Tool
{
    /**
     * @param  OpenAIService  $service  The OpenAI API client
     */
    public function __construct(
        private OpenAIService $service,
    ) {}

    public function name(): string
    {
        return 'openai_list_files';
    }

    public function description(): string
    {
        return 'List files uploaded to OpenAI, optionally filtered by purpose.';
    }

    public function parameters(): array
    {
        return [
            'purpose' => ['type' => 'string', 'description' => 'Filter by purpose: "assistants", "assistants_output", "batch", "fine-tune", "vision".'],
            'limit' => ['type' => 'integer', 'description' => 'Number of files to return (default 20, max 10000).'],
        ];
    }

    /**
     * List uploaded files.
     *
     * @param  array<string, mixed>  $args  Tool arguments (purpose, limit)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('OpenAI integration is not configured.');
            }

            $params = [];

            if (isset($args['purpose'])) {
                $params['purpose'] = $args['purpose'];
            }
            if (isset($args['limit'])) {
                $params['limit'] = (int) $args['limit'];
            }

            $result = $this->service->listFiles($params);

            return ToolResult::success([
                'object' => $result['object'] ?? '',
                'data' => $result['data'] ?? [],
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
