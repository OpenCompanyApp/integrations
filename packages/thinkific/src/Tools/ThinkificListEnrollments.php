<?php

namespace OpenCompany\Integrations\Thinkific\Tools;

use OpenCompany\Integrations\Thinkific\ThinkificService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List enrollments in Thinkific.
 *
 * Supports pagination and optional filtering by course or user.
 */
class ThinkificListEnrollments implements Tool
{
    public function __construct(
        private ThinkificService $service,
    ) {}

    public function name(): string
    {
        return 'thinkific_list_enrollments';
    }

    public function description(): string
    {
        return 'List enrollments in your Thinkific site. Returns enrollment IDs, user info, course details, progress, and completion status. Supports pagination and filtering by course or user.';
    }

    public function parameters(): array
    {
        return [
            'limit' => ['type' => 'integer', 'description' => 'Number of enrollments to return per page (default: 25, max: 250).'],
            'page' => ['type' => 'integer', 'description' => 'Page number for pagination (default: 1).'],
            'course_id' => ['type' => 'integer', 'description' => 'Filter enrollments by course ID.'],
            'user_id' => ['type' => 'integer', 'description' => 'Filter enrollments by user ID.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Thinkific integration is not configured.');
            }

            $limit = isset($args['limit']) ? (int) $args['limit'] : 25;
            $page = isset($args['page']) ? (int) $args['page'] : 1;
            $courseId = isset($args['course_id']) ? (int) $args['course_id'] : null;
            $userId = isset($args['user_id']) ? (int) $args['user_id'] : null;

            $result = $this->service->listEnrollments($limit, $page, $courseId, $userId);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
