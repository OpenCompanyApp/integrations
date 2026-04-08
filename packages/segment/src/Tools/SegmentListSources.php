<?php

namespace OpenCompany\Integrations\Segment\Tools;

use OpenCompany\Integrations\Segment\SegmentService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List sources in a Segment workspace.
 *
 * Retrieves a list of all sources configured in the specified workspace.
 * Requires an API token to be configured.
 */
class SegmentListSources implements Tool
{
    public function __construct(
        private SegmentService $service,
    ) {}

    public function name(): string
    {
        return 'segment_list_sources';
    }

    public function description(): string
    {
        return 'List all sources in a Segment workspace. Requires an API token to be configured.';
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

            $result = $this->service->listSources($args['slug']);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
