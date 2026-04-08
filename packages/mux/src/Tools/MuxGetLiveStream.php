<?php

namespace OpenCompany\Integrations\Mux\Tools;

use OpenCompany\Integrations\Mux\MuxService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool: mux_get_live_stream
 *
 * Retrieve details of a specific live stream by its ID. Returns the
 * stream's status, stream key, playback IDs, and reconnect window.
 */
class MuxGetLiveStream implements Tool
{
    public function __construct(
        private MuxService $service,
    ) {}

    public function name(): string
    {
        return 'mux_get_live_stream';
    }

    public function description(): string
    {
        return 'Retrieve details of a specific live stream by its ID, including status, stream key, playback IDs, and reconnect window.';
    }

    public function parameters(): array
    {
        return [
            'live_stream_id' => ['type' => 'string', 'required' => true, 'description' => 'The ID of the live stream to retrieve.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Mux integration is not configured.');
            }

            if (empty($args['live_stream_id'])) {
                return ToolResult::error('live_stream_id is required.');
            }

            $result = $this->service->getLiveStream($args['live_stream_id']);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
