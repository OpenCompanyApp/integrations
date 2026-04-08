<?php

namespace OpenCompany\Integrations\ElevenLabs\Tools;

use OpenCompany\Integrations\ElevenLabs\ElevenLabsService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get the current ElevenLabs user and subscription information.
 *
 * Returns user profile details along with subscription tier, character usage,
 * and other account-level information useful for understanding quota limits.
 */
class ElevenLabsGetCurrentUser implements Tool
{
    public function __construct(
        private ElevenLabsService $service,
    ) {}

    public function name(): string
    {
        return 'elevenlabs_get_current_user';
    }

    public function description(): string
    {
        return 'Get the current ElevenLabs user profile, subscription tier, and character usage information.';
    }

    public function parameters(): array
    {
        return [];
    }

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
