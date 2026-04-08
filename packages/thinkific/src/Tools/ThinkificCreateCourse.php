<?php

namespace OpenCompany\Integrations\Thinkific\Tools;

use OpenCompany\Integrations\Thinkific\ThinkificService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Create a new course in Thinkific.
 *
 * Requires at minimum a course name.
 */
class ThinkificCreateCourse implements Tool
{
    public function __construct(
        private ThinkificService $service,
    ) {}

    public function name(): string
    {
        return 'thinkific_create_course';
    }

    public function description(): string
    {
        return 'Create a new course in Thinkific. Requires a course name. Optionally include a description and additional course settings.';
    }

    public function parameters(): array
    {
        return [
            'name' => ['type' => 'string', 'required' => true, 'description' => 'The course name.'],
            'description' => ['type' => 'string', 'description' => 'The course description.'],
            'course_card_subtitle' => ['type' => 'string', 'description' => 'Subtitle shown on the course card.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Thinkific integration is not configured.');
            }

            if (empty($args['name'])) {
                return ToolResult::error('The field \'name\' is required.');
            }

            $additional = [];

            if (isset($args['course_card_subtitle'])) {
                $additional['course_card_subtitle'] = $args['course_card_subtitle'];
            }

            $result = $this->service->createCourse(
                $args['name'],
                $args['description'] ?? '',
                $additional,
            );

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
