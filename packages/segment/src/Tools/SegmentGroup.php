<?php

namespace OpenCompany\Integrations\Segment\Tools;

use OpenCompany\Integrations\Segment\SegmentService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Associate a user with a group in Segment.
 *
 * Links a user to an organization, company, or other group entity,
 * along with optional group traits.
 */
class SegmentGroup implements Tool
{
    public function __construct(
        private SegmentService $service,
    ) {}

    public function name(): string
    {
        return 'segment_group';
    }

    public function description(): string
    {
        return 'Associate a user with a group (organization, company, account) in Segment. Lets you record group membership along with optional group traits.';
    }

    public function parameters(): array
    {
        return [
            'groupId' => ['type' => 'string', 'required' => true, 'description' => 'The unique identifier for the group (e.g., company ID, organization ID).'],
            'userId' => ['type' => 'string', 'required' => true, 'description' => 'The unique identifier for the user in your database.'],
            'traits' => ['type' => 'object', 'description' => 'Key-value pairs of group traits (e.g., name, plan, industry, employee_count).'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Segment integration is not configured.');
            }

            $result = $this->service->group(
                groupId: $args['groupId'],
                userId: $args['userId'],
                traits: $args['traits'] ?? [],
            );

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
