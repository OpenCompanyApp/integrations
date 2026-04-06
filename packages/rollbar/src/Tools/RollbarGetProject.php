<?php

namespace OpenCompany\Integrations\Rollbar\Tools;

use OpenCompany\Integrations\Rollbar\RollbarService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool to get a single Rollbar project by its ID.
 *
 * Returns detailed information about the project including its name,
 * status, and associated tokens.
 *
 * @see https://docs.rollbar.com/docs/project
 */
class RollbarGetProject implements Tool
{
    /**
     * Create a new RollbarGetProject tool instance.
     */
    public function __construct(
        private RollbarService $service,
    ) {}

    /**
     * Get the tool name identifier.
     */
    public function name(): string
    {
        return 'rollbar_get_project';
    }

    /**
     * Get the tool description.
     */
    public function description(): string
    {
        return 'Get details for a specific Rollbar project by its ID.';
    }

    /**
     * Get the tool parameter definitions.
     */
    public function parameters(): array
    {
        return [
            'id' => ['type' => 'integer', 'required' => true, 'description' => 'The project ID.'],
        ];
    }

    /**
     * Execute the tool and return the result.
     *
     * @param  array  $args  Tool arguments (id required)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Rollbar integration is not configured.');
            }

            if (!isset($args['id'])) {
                return ToolResult::error('The "id" parameter is required.');
            }

            $id = (int) $args['id'];
            $result = $this->service->getProject($id);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
