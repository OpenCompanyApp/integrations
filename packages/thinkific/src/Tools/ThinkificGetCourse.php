<?php

namespace OpenCompany\Integrations\Thinkific\Tools;

use OpenCompany\Integrations\Thinkific\ThinkificService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get details for a specific Thinkific course by ID.
 */
class ThinkificGetCourse implements Tool
{
    public function __construct(
        private ThinkificService $service,
    ) {}

    public function name(): string
    {
        return 'thinkific_get_course';
    }

    public function description(): string
    {
        return 'Get detailed information about a specific Thinkific course by its ID, including chapters, description, and pricing.';
    }

    public function parameters(): array
    {
        return [
            'id' => ['type' => 'integer', 'required' => true, 'description' => 'The Thinkific course ID.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Thinkific integration is not configured.');
            }

            if (empty($args['id'])) {
                return ToolResult::error('Course ID is required.');
            }

            $result = $this->service->getCourse((int) $args['id']);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
