<?php

namespace OpenCompany\Integrations\Agora\Tools;

use OpenCompany\Integrations\Agora\AgoraService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get the current authenticated Agora user.
 */
class AgoraGetCurrentUser implements Tool
{
    /**
     * @param  AgoraService  $service  The Agora API client
     */
    public function __construct(
        private AgoraService $service,
    ) {}

    public function name(): string
    {
        return 'agora_get_current_user';
    }

    public function description(): string
    {
        return 'Get information about the current authenticated Agora user.';
    }

    public function parameters(): array
    {
        return [];
    }

    /**
     * Get the current authenticated user.
     *
     * @param  array<string, mixed>  $args  Tool arguments (none)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Agora integration is not configured.');
            }

            $result = $this->service->getCurrentUser();

            return ToolResult::success([
                'ok' => true,
                'user' => $result,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
