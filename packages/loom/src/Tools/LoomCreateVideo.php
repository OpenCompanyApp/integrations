<?php

namespace OpenCompany\Integrations\Loom\Tools;

use OpenCompany\Integrations\Loom\LoomService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Create a new Loom video placeholder.
 *
 * Creates a video entry with a title and optional description.
 * Returns the created video details including upload URLs for
 * uploading the actual video content.
 *
 * @see https://developer.loom.com/docs/api-reference
 */
class LoomCreateVideo implements Tool
{
    public function __construct(
        private LoomService $service,
    ) {}

    /**
     * Get the tool identifier.
     */
    public function name(): string
    {
        return 'loom_create_video';
    }

    /**
     * Get the human-readable tool description.
     */
    public function description(): string
    {
        return 'Create a new Loom video with a title and optional description. Returns the video details and upload URLs.';
    }

    /**
     * Get the tool parameter definitions.
     *
     * @return array<string, array{type: string, required?: bool, description: string}>
     */
    public function parameters(): array
    {
        return [
            'title' => ['type' => 'string', 'required' => true, 'description' => 'The title of the video.'],
            'description' => ['type' => 'string', 'description' => 'An optional description for the video.'],
        ];
    }

    /**
     * Execute the create video API call.
     *
     * @param  array{title: string, description?: string}  $args  Must contain a title.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Loom integration is not configured.');
            }

            if (empty($args['title'])) {
                return ToolResult::error('title is required.');
            }

            $result = $this->service->createVideo(
                $args['title'],
                $args['description'] ?? '',
            );

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
