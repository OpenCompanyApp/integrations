<?php

namespace OpenCompany\Integrations\HeyGen\Tools;

use OpenCompany\Integrations\HeyGen\HeyGenService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool for generating a new AI video using the HeyGen API.
 *
 * Accepts the full video generation request body including avatar ID, voice ID,
 * script text, and video settings. Returns the video ID and initial status.
 */
class HeyGenCreateVideo implements Tool
{
    /**
     * Create a new HeyGenCreateVideo tool instance.
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
        return 'heygen_create_video';
    }

    /**
     * Get the human-readable tool description.
     */
    public function description(): string
    {
        return 'Generate a new AI video with a customizable avatar and voice using HeyGen. Provide the video configuration including avatar, voice, and script.';
    }

    /**
     * Get the tool parameter definitions.
     *
     * @return array<string, array{type: string, required?: bool, description: string}>
     */
    public function parameters(): array
    {
        return [
            'video_inputs' => ['type' => 'array', 'required' => true, 'description' => 'Array of video input objects. Each object specifies an avatar (avatar_id, avatar_style), voice (voice_id), and script (text). Example: [{"avatar": {"avatar_id": "xxx", "avatar_style": "normal"}, "voice": {"voice_id": "yyy"}, "script": {"text": "Hello world"}}]'],
            'test' => ['type' => 'boolean', 'description' => 'Set to true for a test video (free, watermarked). Defaults to false.'],
            'title' => ['type' => 'string', 'description' => 'Optional title for the video.'],
            'dimension' => ['type' => 'array', 'description' => 'Video dimensions, e.g. {"width": 1920, "height": 1080}.'],
        ];
    }

    /**
     * Execute the create video tool.
     *
     * @param  array  $args  The tool arguments matching the parameter definitions.
     * @return ToolResult The result containing the video ID or an error message.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('HeyGen integration is not configured.');
            }

            $body = [
                'video_inputs' => $args['video_inputs'],
            ];

            if (isset($args['test'])) {
                $body['test'] = (bool) $args['test'];
            }

            if (isset($args['title'])) {
                $body['title'] = $args['title'];
            }

            if (isset($args['dimension'])) {
                $body['dimension'] = $args['dimension'];
            }

            $result = $this->service->createVideo($body);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
