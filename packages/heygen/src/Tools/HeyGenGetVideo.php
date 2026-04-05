<?php

namespace OpenCompany\Integrations\HeyGen\Tools;

use OpenCompany\Integrations\HeyGen\HeyGenService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool for retrieving the status and details of a HeyGen video by its ID.
 *
 * Returns video status (pending, processing, completed, failed), the video URL
 * when ready, and associated metadata.
 */
class HeyGenGetVideo implements Tool
{
    /**
     * Create a new HeyGenGetVideo tool instance.
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
        return 'heygen_get_video';
    }

    /**
     * Get the human-readable tool description.
     */
    public function description(): string
    {
        return 'Retrieve the status, URL, and details of a HeyGen video by its ID. Use this to check if a video is ready or to get the download link.';
    }

    /**
     * Get the tool parameter definitions.
     *
     * @return array<string, array{type: string, required?: bool, description: string}>
     */
    public function parameters(): array
    {
        return [
            'video_id' => ['type' => 'string', 'required' => true, 'description' => 'The unique identifier of the video.'],
        ];
    }

    /**
     * Execute the get video tool.
     *
     * @param  array  $args  The tool arguments matching the parameter definitions.
     * @return ToolResult The result containing the video details or an error message.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('HeyGen integration is not configured.');
            }

            $result = $this->service->getVideo($args['video_id']);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
