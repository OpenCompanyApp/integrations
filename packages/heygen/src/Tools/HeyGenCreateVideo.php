<?php

namespace OpenCompany\Integrations\HeyGen\Tools;

use OpenCompany\Integrations\HeyGen\HeyGenService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class HeyGenCreateVideo implements Tool
{
    public function __construct(
        private HeyGenService $service,
    ) {}

    public function name(): string
    {
        return 'heygen_create_video';
    }

    public function description(): string
    {
        return 'Generate a new AI video on HeyGen. Provide video_inputs defining scenes (avatar, voice, script), optional dimensions, and test mode. Returns a video_id to track generation progress.';
    }

    public function parameters(): array
    {
        return [
            'video_inputs' => ['type' => 'array', 'required' => true, 'description' => 'Array of video input objects. Each defines a scene with properties like character (avatar_id, voice_id), voice_settings, script, and background. Example: [{"character":{"avatar_id":"...","voice_id":"..."},"script":"Hello world"}]'],
            'dimension' => ['type' => 'array', 'description' => 'Video dimensions as an object with width and height. Example: {"width": 1920, "height": 1080}. Defaults to 1920x1080 if omitted.'],
            'test' => ['type' => 'boolean', 'description' => 'Set to true to generate a test (preview) video. Defaults to false.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('HeyGen integration is not configured.');
            }

            if (empty($args['video_inputs'])) {
                return ToolResult::error('video_inputs is required and must be a non-empty array.');
            }

            $videoInputs = $args['video_inputs'];
            $dimension = $args['dimension'] ?? null;
            $test = isset($args['test']) ? (bool) $args['test'] : false;

            $result = $this->service->createVideo($videoInputs, $dimension, $test);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
