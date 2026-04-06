<?php

namespace OpenCompany\Integrations\Loom\Tools;

use OpenCompany\Integrations\Loom\LoomService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get details for a specific Loom video.
 *
 * Retrieves full video metadata including playback URL, thumbnail,
 * duration, owner information, and sharing settings.
 *
 * @see https://developer.loom.com/docs/api-reference
 */
class LoomGetVideo implements Tool
{
    public function __construct(
        private LoomService $service,
    ) {}

    /**
     * Get the tool identifier.
     */
    public function name(): string
    {
        return 'loom_get_video';
    }

    /**
     * Get the human-readable tool description.
     */
    public function description(): string
    {
        return 'Get detailed information about a specific Loom video by its ID, including playback URL, duration, thumbnail, and metadata.';
    }

    /**
     * Get the tool parameter definitions.
     *
     * @return array<string, array{type: string, required: bool, description: string}>
     */
    public function parameters(): array
    {
        return [
            'video_id' => ['type' => 'string', 'required' => true, 'description' => 'The unique identifier of the Loom video.'],
        ];
    }

    /**
     * Execute the get video API call.
     *
     * @param  array{video_id: string}  $args  Must contain the video ID.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Loom integration is not configured.');
            }

            if (empty($args['video_id'])) {
                return ToolResult::error('video_id is required.');
            }

            $result = $this->service->getVideo($args['video_id']);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
