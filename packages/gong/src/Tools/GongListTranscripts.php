<?php

namespace OpenCompany\Integrations\Gong\Tools;

use OpenCompany\Integrations\Gong\GongService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool for listing transcripts from Gong.
 *
 * Retrieves call transcript data via the GET /v1/transcripts endpoint,
 * supporting filtering by download date, call type, status, and pagination.
 */
class GongListTranscripts implements Tool
{
    /**
     * Create a new GongListTranscripts tool instance.
     */
    public function __construct(
        private GongService $service,
    ) {}

    /**
     * Get the tool name identifier.
     */
    public function name(): string
    {
        return 'gong_list_transcripts';
    }

    /**
     * Get the tool description for AI agent consumption.
     */
    public function description(): string
    {
        return 'List call transcripts from Gong. Filter by download date, call type, or status. Returns transcript metadata including call ID, language, and processing status.';
    }

    /**
     * Get the tool parameter schema.
     *
     * @return array<string, array<string, mixed>>
     */
    public function parameters(): array
    {
        return [
            'page' => ['type' => 'integer', 'description' => 'Page number for pagination (starting from 1).'],
            'limit' => ['type' => 'integer', 'description' => 'Maximum number of transcripts to return per page.'],
            'download_date' => ['type' => 'string', 'description' => 'Filter transcripts by download date in ISO 8601 format (e.g., "2025-01-15").'],
            'call_type' => ['type' => 'string', 'description' => 'Filter by call type (e.g., "conference", "webinar", "phone").'],
            'status' => ['type' => 'string', 'description' => 'Filter by transcript processing status (e.g., "completed", "processing", "failed").'],
        ];
    }

    /**
     * Execute the list transcripts tool.
     *
     * @param  array  $args  Tool arguments matching the parameter schema.
     * @return ToolResult The result containing transcript data or an error message.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Gong integration is not configured.');
            }

            $query = [];

            if (isset($args['page'])) {
                $query['page'] = $args['page'];
            }
            if (isset($args['limit'])) {
                $query['limit'] = $args['limit'];
            }
            if (isset($args['download_date'])) {
                $query['downloadDate'] = $args['download_date'];
            }
            if (isset($args['call_type'])) {
                $query['callType'] = $args['call_type'];
            }
            if (isset($args['status'])) {
                $query['status'] = $args['status'];
            }

            $result = $this->service->listTranscripts($query);

            $transcripts = $result['transcripts'] ?? $result['records'] ?? [];
            $totalCount = count($transcripts);
            $response = [
                'transcripts' => $transcripts,
                'count' => $totalCount,
            ];

            if (isset($result['totalRecords'])) {
                $response['totalRecords'] = $result['totalRecords'];
            }
            if (isset($result['records']['totalRecords'])) {
                $response['totalRecords'] = $result['records']['totalRecords'];
            }
            if (isset($result['cursor'])) {
                $response['cursor'] = $result['cursor'];
            }

            return ToolResult::success($response);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
