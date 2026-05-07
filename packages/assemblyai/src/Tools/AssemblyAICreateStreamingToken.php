<?php

namespace OpenCompany\Integrations\AssemblyAI\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\AssemblyAI\AssemblyAIService;

/**
 * Generate a temporary AssemblyAI Streaming Speech-to-Text token.
 */
class AssemblyAICreateStreamingToken implements Tool
{
    /**
     * @param  AssemblyAIService  $service  The AssemblyAI API client.
     */
    public function __construct(private AssemblyAIService $service) {}

    public function name(): string
    {
        return 'assemblyai_create_streaming_token';
    }

    public function description(): string
    {
        return 'Generate a temporary token for browser or client-side Streaming Speech-to-Text sessions.';
    }

    public function parameters(): array
    {
        return [
            'expires_in_seconds' => ['type' => 'integer', 'required' => true, 'description' => 'Token lifetime from 1 to 600 seconds.'],
            'max_session_duration_seconds' => ['type' => 'integer', 'description' => 'Maximum streaming session duration from 60 to 10800 seconds.'],
        ];
    }

    /**
     * Generate a temporary streaming token.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('AssemblyAI integration is not configured.');
            }

            return ToolResult::success($this->service->createStreamingToken(
                (int) ($args['expires_in_seconds'] ?? 60),
                isset($args['max_session_duration_seconds']) ? (int) $args['max_session_duration_seconds'] : null,
            ));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
