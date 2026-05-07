<?php

namespace OpenCompany\Integrations\AssemblyAI\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\AssemblyAI\AssemblyAIService;

/**
 * Delete a transcript and its associated uploaded media data.
 */
class AssemblyAIDeleteTranscript implements Tool
{
    /**
     * @param  AssemblyAIService  $service  The AssemblyAI API client.
     */
    public function __construct(private AssemblyAIService $service) {}

    public function name(): string
    {
        return 'assemblyai_delete_transcript';
    }

    public function description(): string
    {
        return 'Delete an AssemblyAI transcript and remove associated uploaded file data from AssemblyAI systems.';
    }

    public function parameters(): array
    {
        return ['id' => ['type' => 'string', 'required' => true, 'description' => 'Transcript ID.']];
    }

    /**
     * Delete a transcript by id.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('AssemblyAI integration is not configured.');
            }

            return ToolResult::success($this->service->deleteTranscript((string) ($args['id'] ?? '')));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
