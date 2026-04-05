<?php

namespace OpenCompany\Integrations\Segment\Tools;

use OpenCompany\Integrations\Segment\SegmentService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get a specific Segment source.
 *
 * Retrieves details of a single source from the specified workspace.
 * Requires an API token to be configured.
 */
class SegmentGetSource implements Tool
{
    public function __construct(
        private SegmentService $service,
    ) {}

    public function name(): string
    {
        return 'segment_get_source';
    }

    public function description(): string
    {
        return 'Get details of a specific Segment source by ID. Requires an API token to be configured.';
    }

    public function parameters(): array
    {
        return [
            'slug' => ['type' => 'string', 'required' => true, 'description' => 'The workspace slug (e.g., "my-workspace").'],
            'id' => ['type' => 'string', 'required' => true, 'description' => 'The source ID (e.g., "abc123").'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Segment integration is not configured.');
            }

            $result = $this->service->getSource($args['slug'], $args['id']);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
