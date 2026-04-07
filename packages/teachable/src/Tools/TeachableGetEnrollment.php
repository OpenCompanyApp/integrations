<?php

namespace OpenCompany\Integrations\Teachable\Tools;

use OpenCompany\Integrations\Teachable\TeachableService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool to get a single enrollment from a Teachable school by ID.
 */
class TeachableGetEnrollment implements Tool
{
    /**
     * Create a new TeachableGetEnrollment tool instance.
     */
    public function __construct(
        private TeachableService $service,
    ) {}

    /**
     * Get the tool name identifier.
     */
    public function name(): string
    {
        return 'teachable_get_enrollment';
    }

    /**
     * Get the tool description.
     */
    public function description(): string
    {
        return 'Get a single enrollment from your Teachable school by its enrollment ID.';
    }

    /**
     * Get the tool parameter definitions.
     */
    public function parameters(): array
    {
        return [
            'enrollment_id' => ['type' => 'string', 'required' => true, 'description' => 'The ID of the enrollment to retrieve.'],
        ];
    }

    /**
     * Execute the tool — get an enrollment from Teachable.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Teachable integration is not configured. Provide an API key.');
            }

            $result = $this->service->getEnrollment($args['enrollment_id']);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
