<?php

namespace OpenCompany\Integrations\HeyGen\Tools;

use OpenCompany\Integrations\HeyGen\HeyGenService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool for listing available avatars from the HeyGen API.
 *
 * Returns all avatars accessible to the authenticated user, including
 * their IDs, names, preview images, and supported styles.
 */
class HeyGenListAvatars implements Tool
{
    /**
     * Create a new HeyGenListAvatars tool instance.
     *
     * @param  HeyGenService  $service  The HeyGen API service.
     */
    public function __construct(
        private HeyGenService $service,
    ) {}

    /**
     * Get the tool identifier.
     */
    public function name(): string
    {
        return 'heygen_list_avatars';
    }

    /**
     * Get the human-readable tool description.
     */
    public function description(): string
    {
        return 'List all available avatars in HeyGen. Returns avatar IDs, names, preview images, and supported styles for use in video generation.';
    }

    /**
     * Get the tool parameter definitions.
     *
     * @return array<string, array{type: string, required?: bool, description: string}>
     */
    public function parameters(): array
    {
        return [];
    }

    /**
     * Execute the list avatars tool.
     *
     * @param  array  $args  The tool arguments (none required).
     * @return ToolResult The result containing the list of avatars or an error message.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('HeyGen integration is not configured.');
            }

            $result = $this->service->listAvatars();

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
