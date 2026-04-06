<?php

namespace OpenCompany\Integrations\Loom\Tools;

use OpenCompany\Integrations\Loom\LoomService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Delete a Loom video by its ID.
 *
 * Permanently removes a video from Loom. This action is irreversible
 * and will remove all associated comments, reactions, and analytics data.
 *
 * @see https://developer.loom.com/docs/api-reference
 */
class LoomDeleteVideo implements Tool
{
    public function __construct(
        private LoomService $service,
    ) {}

    /**
     * Get the tool identifier.
     */
    public function name(): string
    {
        return 'loom_delete_video';
    }

    /**
     * Get the human-readable tool description.
     */
    public function description(): string
    {
        return 'Delete a Loom video permanently. This action cannot be undone.';
    }

    /**
     * Get the tool parameter definitions.
     *
     * @return array<string, array{type: string, required: bool, description: string}>
     */
    public function parameters(): array
    {
        return [
            'video_id' => ['type' => 'string', 'required' => true, 'description' => 'The unique identifier of the Loom video to delete.'],
        ];
    }

    /**
     * Execute the delete video API call.
     *
     * @param  array{video_id: string}  $args  Must contain the video ID to delete.
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

            $this->service->deleteVideo($args['video_id']);

            return ToolResult::success("Video '{$args['video_id']}' has been deleted.");
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
