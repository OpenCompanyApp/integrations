<?php

namespace OpenCompany\Integrations\Teachable\Tools;

use OpenCompany\Integrations\Teachable\TeachableService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool to list enrollments from a Teachable school.
 *
 * Supports filtering by user_id or course_id and pagination via page/per_page parameters.
 */
class TeachableListEnrollments implements Tool
{
    /**
     * Create a new TeachableListEnrollments tool instance.
     */
    public function __construct(
        private TeachableService $service,
    ) {}

    /**
     * Get the tool name identifier.
     */
    public function name(): string
    {
        return 'teachable_list_enrollments';
    }

    /**
     * Get the tool description.
     */
    public function description(): string
    {
        return 'List enrollments from your Teachable school. Filter by user_id or course_id and paginate with page/per_page.';
    }

    /**
     * Get the tool parameter definitions.
     */
    public function parameters(): array
    {
        return [
            'user_id' => ['type' => 'string', 'description' => 'Filter enrollments by user ID.'],
            'course_id' => ['type' => 'string', 'description' => 'Filter enrollments by course ID.'],
            'page' => ['type' => 'integer', 'description' => 'Page number for pagination (default: 1).'],
            'per_page' => ['type' => 'integer', 'description' => 'Number of enrollments per page (default: 25, max: 100).'],
        ];
    }

    /**
     * Execute the tool — list enrollments from Teachable.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Teachable integration is not configured. Provide an API key.');
            }

            $params = [];

            if (isset($args['user_id'])) {
                $params['user_id'] = $args['user_id'];
            }
            if (isset($args['course_id'])) {
                $params['course_id'] = $args['course_id'];
            }
            if (isset($args['page'])) {
                $params['page'] = (int) $args['page'];
            }
            if (isset($args['per_page'])) {
                $params['per_page'] = (int) $args['per_page'];
            }

            $result = $this->service->listEnrollments($params);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
