<?php

namespace OpenCompany\Integrations\Litmos\Tools;

use OpenCompany\Integrations\Litmos\LitmosService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get details for a specific Litmos course by ID.
 */
class LitmosGetCourse implements Tool
{
    public function __construct(
        private LitmosService $service,
    ) {}

    public function name(): string
    {
        return 'litmos_get_course';
    }

    public function description(): string
    {
        return 'Get detailed information about a specific Litmos course by its ID, including modules, description, and completion settings.';
    }

    public function parameters(): array
    {
        return [
            'id' => ['type' => 'string', 'required' => true, 'description' => 'The Litmos course ID.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Litmos integration is not configured.');
            }

            if (empty($args['id'])) {
                return ToolResult::error('Course ID is required.');
            }

            $result = $this->service->getCourse($args['id']);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
