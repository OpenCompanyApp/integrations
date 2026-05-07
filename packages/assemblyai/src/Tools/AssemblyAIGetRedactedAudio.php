<?php

namespace OpenCompany\Integrations\AssemblyAI\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\AssemblyAI\AssemblyAIService;

/**
 * Retrieve the generated redacted audio URL for a transcript.
 */
class AssemblyAIGetRedactedAudio implements Tool
{
    /**
     * @param  AssemblyAIService  $service  The AssemblyAI API client.
     */
    public function __construct(private AssemblyAIService $service) {}

    public function name(): string
    {
        return 'assemblyai_get_redacted_audio';
    }

    public function description(): string
    {
        return 'Get redacted audio for a transcript created with redact_pii_audio enabled.';
    }

    public function parameters(): array
    {
        return ['id' => ['type' => 'string', 'required' => true, 'description' => 'Transcript ID.']];
    }

    /**
     * Retrieve redacted audio metadata.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('AssemblyAI integration is not configured.');
            }

            return ToolResult::success($this->service->getRedactedAudio((string) ($args['id'] ?? '')));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
