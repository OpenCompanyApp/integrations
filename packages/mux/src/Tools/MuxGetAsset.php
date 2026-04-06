<?php

namespace OpenCompany\Integrations\Mux\Tools;

use OpenCompany\Integrations\Mux\MuxService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool: mux_get_asset
 *
 * Retrieve details of a specific video asset by its ID. Returns the
 * asset's status, playback IDs, duration, tracks, and other metadata.
 */
class MuxGetAsset implements Tool
{
    public function __construct(
        private MuxService $service,
    ) {}

    public function name(): string
    {
        return 'mux_get_asset';
    }

    public function description(): string
    {
        return 'Retrieve details of a specific video asset by its ID, including status, playback IDs, duration, and tracks.';
    }

    public function parameters(): array
    {
        return [
            'asset_id' => ['type' => 'string', 'required' => true, 'description' => 'The ID of the asset to retrieve.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Mux integration is not configured.');
            }

            if (empty($args['asset_id'])) {
                return ToolResult::error('asset_id is required.');
            }

            $result = $this->service->getAsset($args['asset_id']);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
