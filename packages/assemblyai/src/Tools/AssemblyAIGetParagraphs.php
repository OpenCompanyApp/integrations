<?php

namespace OpenCompany\Integrations\AssemblyAI\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\AssemblyAI\AssemblyAIService;

/**
 * Export an AssemblyAI transcript split into semantic paragraphs.
 */
class AssemblyAIGetParagraphs implements Tool
{
    /**
     * @param  AssemblyAIService  $service  The AssemblyAI API client.
     */
    public function __construct(private AssemblyAIService $service) {}

    public function name(): string
    {
        return 'assemblyai_get_paragraphs';
    }

    public function description(): string
    {
        return 'Get a completed transcript split into semantic paragraphs with timestamps and words.';
    }

    public function parameters(): array
    {
        return ['id' => ['type' => 'string', 'required' => true, 'description' => 'Transcript ID.']];
    }

    /**
     * Retrieve paragraph export for a transcript.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('AssemblyAI integration is not configured.');
            }

            return ToolResult::success($this->service->getParagraphs((string) ($args['id'] ?? '')));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
