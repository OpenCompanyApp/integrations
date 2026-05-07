<?php

namespace OpenCompany\Integrations\BlandAI\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\BlandAI\BlandAIService;

/**
 * Get Bland AI voice details.
 *
 * Accepts a voice preset name or custom voice ID.
 */
class BlandAIGetVoice implements Tool
{
    /**
     * @param  BlandAIService  $service  The Bland AI API client
     */
    public function __construct(private BlandAIService $service) {}

    public function name(): string
    {
        return 'blandai_get_voice';
    }

    public function description(): string
    {
        return 'Get details for a Bland AI voice by name or ID.';
    }

    public function parameters(): array
    {
        return ['voice_id' => ['type' => 'string', 'required' => true, 'description' => 'Voice name or ID.']];
    }

    /**
     * Get voice details.
     *
     * @param  array<string, mixed>  $args  Tool arguments
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('BlandAI integration is not configured.');
            }

            return ToolResult::success($this->service->getVoice((string) ($args['voice_id'] ?? '')));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
