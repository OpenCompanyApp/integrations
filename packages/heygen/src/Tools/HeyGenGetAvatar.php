<?php

namespace OpenCompany\Integrations\HeyGen\Tools;

use OpenCompany\Integrations\HeyGen\HeyGenService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool for retrieving details of a specific HeyGen avatar by its ID.
 *
 * Returns the avatar's full details including preview images, supported
 * styles, and configuration options available for video generation.
 */
class HeyGenGetAvatar implements Tool
{
    /**
     * Create a new HeyGenGetAvatar tool instance.
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
        return 'heygen_get_avatar';
    }

    /**
     * Get the human-readable tool description.
     */
    public function description(): string
    {
        return 'Retrieve details of a specific HeyGen avatar by ID. Returns preview images, supported styles, and configuration options.';
    }

    /**
     * Get the tool parameter definitions.
     *
     * @return array<string, array{type: string, required?: bool, description: string}>
     */
    public function parameters(): array
    {
        return [
            'avatar_id' => ['type' => 'string', 'required' => true, 'description' => 'The unique identifier of the avatar.'],
        ];
    }

    /**
     * Execute the get avatar tool.
     *
     * @param  array  $args  The tool arguments matching the parameter definitions.
     * @return ToolResult The result containing the avatar details or an error message.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('HeyGen integration is not configured.');
            }

            $result = $this->service->getAvatar($args['avatar_id']);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
