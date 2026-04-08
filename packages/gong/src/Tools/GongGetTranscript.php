<?php

namespace OpenCompany\Integrations\Gong\Tools;

use OpenCompany\Integrations\Gong\GongService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool for retrieving a specific call transcript from Gong.
 *
 * Fetches the full transcript text and metadata for a single call
 * via the GET /v1/transcripts/{id} endpoint.
 */
class GongGetTranscript implements Tool
{
    /**
     * Create a new GongGetTranscript tool instance.
     */
    public function __construct(
        private GongService $service,
    ) {}

    /**
     * Get the tool name identifier.
     */
    public function name(): string
    {
        return 'gong_get_transcript';
    }

    /**
     * Get the tool description for AI agent consumption.
     */
    public function description(): string
    {
        return 'Get the full transcript of a specific call in Gong, including speaker turns, timestamps, and transcript metadata.';
    }

    /**
     * Get the tool parameter schema.
     *
     * @return array<string, array<string, mixed>>
     */
    public function parameters(): array
    {
        return [
            'transcript_id' => ['type' => 'string', 'required' => true, 'description' => 'The unique transcript identifier.'],
        ];
    }

    /**
     * Execute the get transcript tool.
     *
     * @param  array  $args  Tool arguments containing the transcript_id.
     * @return ToolResult The result containing transcript details or an error message.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Gong integration is not configured.');
            }

            $result = $this->service->getTranscript($args['transcript_id']);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
