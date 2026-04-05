<?php

namespace OpenCompany\Integrations\Segment\Tools;

use OpenCompany\Integrations\Segment\SegmentService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Identify a user in Segment.
 *
 * Links metadata (traits) about a particular user to a known userId.
 * This is used to create or update user profiles in Segment and downstream destinations.
 */
class SegmentIdentify implements Tool
{
    public function __construct(
        private SegmentService $service,
    ) {}

    public function name(): string
    {
        return 'segment_identify';
    }

    public function description(): string
    {
        return 'Identify a user in Segment with their traits. Links metadata about a user (name, email, plan, etc.) to a known userId so all their events can be attributed correctly.';
    }

    public function parameters(): array
    {
        return [
            'userId' => ['type' => 'string', 'required' => true, 'description' => 'The unique identifier for the user in your database.'],
            'traits' => ['type' => 'object', 'description' => 'Key-value pairs of user traits (e.g., name, email, plan, role, company).'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Segment integration is not configured.');
            }

            $result = $this->service->identify(
                userId: $args['userId'],
                traits: $args['traits'] ?? [],
            );

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
