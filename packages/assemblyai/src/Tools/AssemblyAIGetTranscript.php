<?php

namespace OpenCompany\Integrations\AssemblyAI\Tools;

use OpenCompany\Integrations\AssemblyAI\AssemblyAIService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Retrieve a transcript by its ID.
 *
 * Sends a GET request to /transcript/{id} and returns the full transcript
 * resource including status, text, confidence, and any enabled features
 * like speaker labels, chapters, or sentiment analysis.
 *
 * @see https://www.assemblyai.com/docs/getting-started/transcribe-an-audio-file
 */
class AssemblyAIGetTranscript implements Tool
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
        return 'assemblyai_get_transcript';
    }

    /**
     * Human-readable description of what this tool does.
     */
    public function description(): string
    {
        return 'Retrieve a transcript by ID. Returns the transcription text, status (queued, processing, completed, error), confidence score, and any enabled AI features like speaker labels, chapters, or sentiment analysis.';
    }

    /**
     * Parameter schema for retrieving a transcript.
     *
     * @return array<string, array{type: string, required?: bool, description: string}>
     */
    public function parameters(): array
    {
        return [
            'id' => ['type' => 'string', 'required' => true, 'description' => 'The transcript ID returned by the transcribe tool.'],
        ];
    }

    /**
     * Execute the get transcript request.
     *
     * @param  array  $args  Must contain 'id' key with the transcript ID.
     * @return ToolResult The transcript resource or an error.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('AssemblyAI integration is not configured.');
            }

            $result = $this->service->getTranscript($args['id']);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
