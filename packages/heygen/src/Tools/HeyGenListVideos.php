<?php

namespace OpenCompany\Integrations\HeyGen\Tools;

use OpenCompany\Integrations\HeyGen\HeyGenService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool for listing generated videos from the HeyGen API.
 *
 * Returns a paginated list of videos with their IDs, titles, statuses,
 * and creation dates. Supports offset-based pagination.
 */
class HeyGenListVideos implements Tool
{
    /**
     * Create a new HeyGenListVideos tool instance.
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
        return 'heygen_list_videos';
    }

    /**
     * Get the human-readable tool description.
     */
    public function description(): string
    {
        return 'List generated videos from HeyGen with pagination. Returns video IDs, titles, statuses, and creation dates.';
    }

    /**
     * Get the tool parameter definitions.
     *
     * @return array<string, array{type: string, required?: bool, description: string}>
     */
    public function parameters(): array
    {
        return [
            'limit' => ['type' => 'integer', 'description' => 'Maximum number of videos to return per page (default: 10).'],
            'offset' => ['type' => 'integer', 'description' => 'Offset for pagination (0-based). Use for fetching subsequent pages.'],
        ];
    }

    /**
     * Execute the list videos tool.
     *
     * @param  array  $args  The tool arguments matching the parameter definitions.
     * @return ToolResult The result containing the list of videos or an error message.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('HeyGen integration is not configured.');
            }

            $limit = isset($args['limit']) ? (int) $args['limit'] : 10;
            $offset = isset($args['offset']) ? (int) $args['offset'] : null;

            $result = $this->service->listVideos($limit, $offset);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
