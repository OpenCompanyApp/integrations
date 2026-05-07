<?php

namespace OpenCompany\Integrations\ElevenLabs\Tools;

use OpenCompany\Integrations\ElevenLabs\ElevenLabsService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool: elevenlabs_get_current_user
 *
 * Retrieves the authenticated user's profile and subscription information
 * from ElevenLabs. Useful for verifying credentials and checking usage limits.
 */
class ElevenLabsGetCurrentUser implements Tool
{
    /**
     * @param ElevenLabsService $service The ElevenLabs API service instance.
     */
    public function __construct(
        private ElevenLabsService $service,
    ) {}

    public function name(): string
    {
        return 'elevenlabs_get_current_user';
    }

    public function description(): string
    {
        return 'Get your ElevenLabs account details, including subscription tier, character usage, and remaining quota.';
    }

    /**
     * @return array<string, array{type: string, description: string}>
     */
    public function parameters(): array
    {
        return [];
    }

    /**
     * Fetch current account details.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('ElevenLabs integration is not configured.');
            }

            $result = $this->service->getCurrentUser();

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
