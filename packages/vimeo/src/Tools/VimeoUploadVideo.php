<?php

namespace OpenCompany\Integrations\Vimeo\Tools;

use OpenCompany\Integrations\Vimeo\VimeoService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Create a Vimeo upload ticket.
 */
class VimeoUploadVideo implements Tool
{
    /**
     * @param  VimeoService  $service  The Vimeo API client.
     */
    public function __construct(
        private VimeoService $service,
    ) {}

    public function name(): string
    {
        return 'vimeo_upload_video';
    }

    public function description(): string
    {
        return 'Create an upload ticket for a new video on Vimeo. Returns the upload URL and video object. Use the upload link to POST the video file binary.';
    }

    public function parameters(): array
    {
        return [
            'name' => ['type' => 'string', 'description' => 'Title of the video.'],
            'description' => ['type' => 'string', 'description' => 'Description of the video.'],
            'privacy' => ['type' => 'string', 'description' => 'Privacy setting: "anybody", "nobody", "contacts", "password", "disable", "unlisted".'],
        ];
    }

    /**
     * Create the upload ticket.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Vimeo integration is not configured.');
            }

            $result = $this->service->uploadVideo($args);

            $uploadLink = $result['upload']['upload_link'] ?? null;
            $videoUri = $result['uri'] ?? null;

            $message = 'Upload ticket created.';
            if ($uploadLink) {
                $message .= " Upload the video file via POST to the returned upload_link.";
            }

            return ToolResult::success([
                'message' => $message,
                'upload_link' => $uploadLink,
                'video_uri' => $videoUri,
                'video' => $result,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
