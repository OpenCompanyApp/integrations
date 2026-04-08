<?php

namespace OpenCompany\Integrations\Segment\Tools;

use OpenCompany\Integrations\Segment\SegmentService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get a Segment workspace by slug.
 *
 * Retrieves details of a specific workspace using the Segment Public API.
 * Requires an API token to be configured.
 */
class SegmentGetWorkspace implements Tool
{
    public function __construct(
        private SegmentService $service,
    ) {}

    public function name(): string
    {
        return 'segment_get_workspace';
    }

    public function description(): string
    {
        return 'Get details of a Segment workspace by its slug. Requires an API token to be configured.';
    }

    public function parameters(): array
    {
        return [
            'slug' => ['type' => 'string', 'required' => true, 'description' => 'The workspace slug (e.g., "my-workspace").'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Segment integration is not configured.');
            }

            $result = $this->service->getWorkspace($args['slug']);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
