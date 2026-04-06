<?php

namespace OpenCompany\Integrations\AssemblyAI\Tools;

use OpenCompany\Integrations\AssemblyAI\AssemblyAIService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List transcripts with optional filtering and pagination.
 *
 * Sends a GET request to /transcripts with query parameters for filtering
 * by status, date, and more. Returns a paginated list of transcript resources.
 *
 * @see https://www.assemblyai.com/docs/assemblyai-api#list-transcripts
 */
class AssemblyAIListTranscripts implements Tool
{
    /**
     * @param  AssemblyAIService  $service  The AssemblyAI service instance.
     */
    public function __construct(
        private AssemblyAIService $service,
    ) {}

    /**
     * The tool identifier.
     */
    public function name(): string
    {
        return 'assemblyai_list_transcripts';
    }

    /**
     * Human-readable description of what this tool does.
     */
    public function description(): string
    {
        return 'List transcripts with optional filtering by status, date range, and pagination. Returns transcript IDs, statuses, and metadata.';
    }

    /**
     * Parameter schema for listing transcripts.
     *
     * @return array<string, array{type: string, required?: bool, description: string}>
     */
    public function parameters(): array
    {
        return [
            'limit' => ['type' => 'integer', 'description' => 'Maximum number of transcripts to return per page (default: 20, max: 200).'],
            'status' => ['type' => 'string', 'description' => 'Filter by status: "queued", "processing", "completed", or "error".'],
            'created_on' => ['type' => 'string', 'description' => 'Filter by creation date. Accepts a date string or operator (e.g., "gte:2025-01-01").'],
            'before_id' => ['type' => 'string', 'description' => 'Return transcripts created before this transcript ID (for pagination).'],
            'after_id' => ['type' => 'string', 'description' => 'Return transcripts created after this transcript ID (for pagination).'],
            'throttled_only' => ['type' => 'boolean', 'description' => 'Only return throttled transcripts.'],
        ];
    }

    /**
     * Execute the list transcripts request.
     *
     * @param  array  $args  Optional filtering and pagination parameters.
     * @return ToolResult Paginated list of transcripts or an error.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('AssemblyAI integration is not configured.');
            }

            $params = [];
            $forwardKeys = ['limit', 'status', 'created_on', 'before_id', 'after_id', 'throttled_only'];

            foreach ($forwardKeys as $key) {
                if (isset($args[$key])) {
                    $params[$key] = $args[$key];
                }
            }

            $result = $this->service->listTranscripts($params);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
