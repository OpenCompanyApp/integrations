<?php

namespace OpenCompany\Integrations\Mux\Tools;

use OpenCompany\Integrations\Mux\MuxService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool: mux_create_live_stream
 *
 * Create a new live stream in Mux. Returns the stream key and playback
 * information needed to start broadcasting. Optionally specify a playback
 * policy and settings for assets created from the stream.
 */
class MuxCreateLiveStream implements Tool
{
    public function __construct(
        private MuxService $service,
    ) {}

    public function name(): string
    {
        return 'mux_create_live_stream';
    }

    public function description(): string
    {
        return 'Create a new live stream in Mux. Returns the stream key and playback information. Optionally set playback policy and asset creation settings.';
    }

    public function parameters(): array
    {
        return [
            'playback_policy' => ['type' => 'array', 'description' => 'Playback policy for the live stream. Use ["public"] for unrestricted access or ["signed"] for signed URLs. Defaults to the workspace default.'],
            'new_asset_settings' => ['type' => 'object', 'description' => 'Settings applied to assets created from this live stream. Supports any Mux asset creation parameters (e.g., {"playback_policy": ["public"], "mp4_support": "standard"}).'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Mux integration is not configured.');
            }

            $playbackPolicy = $args['playback_policy'] ?? null;
            $newAssetSettings = $args['new_asset_settings'] ?? null;

            $result = $this->service->createLiveStream($playbackPolicy, $newAssetSettings);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
