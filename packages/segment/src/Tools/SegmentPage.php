<?php

namespace OpenCompany\Integrations\Segment\Tools;

use OpenCompany\Integrations\Segment\SegmentService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Record a page view in Segment.
 *
 * Lets you record page views on your website or app,
 * along with optional properties about the page.
 */
class SegmentPage implements Tool
{
    public function __construct(
        private SegmentService $service,
    ) {}

    public function name(): string
    {
        return 'segment_page';
    }

    public function description(): string
    {
        return 'Record a page view in Segment. Tracks when a user views a page, along with optional properties about the page.';
    }

    public function parameters(): array
    {
        return [
            'name' => ['type' => 'string', 'required' => true, 'description' => 'The name of the page viewed (e.g., "Homepage", "Product Listing").'],
            'userId' => ['type' => 'string', 'required' => true, 'description' => 'The unique identifier for the user in your database.'],
            'properties' => ['type' => 'object', 'description' => 'Key-value pairs of page properties (e.g., url, referrer, title, path).'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Segment integration is not configured.');
            }

            $result = $this->service->page(
                name: $args['name'],
                userId: $args['userId'],
                properties: $args['properties'] ?? [],
            );

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
