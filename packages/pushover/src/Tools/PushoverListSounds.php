<?php

namespace OpenCompany\Integrations\Pushover\Tools;

use OpenCompany\Integrations\Pushover\PushoverService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List built-in and account-specific Pushover notification sounds.
 */
class PushoverListSounds implements Tool
{
    /**
     * @param  PushoverService  $service  The Pushover API client.
     */
    public function __construct(
        private PushoverService $service,
    ) {}

    public function name(): string
    {
        return 'pushover_list_sounds';
    }

    public function description(): string
    {
        return 'List available notification sounds in Pushover. Use sound names with the send_message tool.';
    }

    public function parameters(): array
    {
        return [];
    }

    /**
     * List notification sounds available to the configured application token.
     *
     * @param  array<string, mixed>  $args  Tool arguments; none are required.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Pushover integration is not configured.');
            }

            $result = $this->service->listSounds();

            $sounds = $result['sounds'] ?? [];

            return ToolResult::success([
                'sounds' => $sounds,
                'count' => count($sounds),
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
