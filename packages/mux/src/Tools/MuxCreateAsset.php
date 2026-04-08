<?php

namespace OpenCompany\Integrations\Mux\Tools;

use OpenCompany\Integrations\Mux\MuxService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool: mux_create_asset
 *
 * Create a new video asset in Mux from an input URL. The asset will be
 * ingested and encoded asynchronously. Optionally specify a playback policy
 * to control access (public or signed).
 */
class MuxCreateAsset implements Tool
{
    public function __construct(
        private MuxService $service,
    ) {}

    public function name(): string
    {
        return 'mux_create_asset';
    }

    public function description(): string
    {
        return 'Create a new video asset in Mux from an input URL. The asset is ingested and encoded asynchronously. Optionally set a playback policy (public or signed).';
    }

    public function parameters(): array
    {
        return [
            'input' => ['type' => 'string', 'required' => true, 'description' => 'The URL of the video file to ingest (e.g., "https://storage.example.com/video.mp4").'],
            'playback_policy' => ['type' => 'array', 'description' => 'Playback policy for the asset. Use ["public"] for unrestricted access or ["signed"] for signed URLs. Defaults to the workspace default.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Mux integration is not configured.');
            }

            if (empty($args['input'])) {
                return ToolResult::error('input is required.');
            }

            $playbackPolicy = $args['playback_policy'] ?? null;
            $result = $this->service->createAsset($args['input'], $playbackPolicy);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
