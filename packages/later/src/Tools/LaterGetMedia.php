<?php

namespace OpenCompany\Integrations\Later\Tools;

use OpenCompany\Integrations\Later\LaterService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get a single media item by ID in Later.
 *
 * Returns detailed information about a specific media asset,
 * including its URL, dimensions, file type, and metadata.
 */
class LaterGetMedia implements Tool
{
    public function __construct(
        private LaterService $service,
    ) {}

    public function name(): string
    {
        return 'later_get_media';
    }

    public function description(): string
    {
        return 'Get details of a specific media item in Later by its ID. Returns the media URL, type, dimensions, and metadata.';
    }

    public function parameters(): array
    {
        return [
            'mediaId' => ['type' => 'string', 'required' => true, 'description' => 'The media item ID to retrieve.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Later integration is not configured.');
            }

            $result = $this->service->getMedia($args['mediaId']);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
