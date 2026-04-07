<?php

namespace OpenCompany\Integrations\Teachable\Tools;

use OpenCompany\Integrations\Teachable\TeachableService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool to get a single course from a Teachable school by ID.
 */
class TeachableGetCourse implements Tool
{
    /**
     * Create a new TeachableGetCourse tool instance.
     */
    public function __construct(
        private TeachableService $service,
    ) {}

    /**
     * Get the tool name identifier.
     */
    public function name(): string
    {
        return 'teachable_get_course';
    }

    /**
     * Get the tool description.
     */
    public function description(): string
    {
        return 'Get a single course from your Teachable school by its course ID.';
    }

    /**
     * Get the tool parameter definitions.
     */
    public function parameters(): array
    {
        return [
            'course_id' => ['type' => 'string', 'required' => true, 'description' => 'The ID of the course to retrieve.'],
        ];
    }

    /**
     * Execute the tool — get a course from Teachable.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Teachable integration is not configured. Provide an API key.');
            }

            $result = $this->service->getCourse($args['course_id']);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
