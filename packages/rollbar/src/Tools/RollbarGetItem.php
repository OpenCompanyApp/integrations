<?php

namespace OpenCompany\Integrations\Rollbar\Tools;

use OpenCompany\Integrations\Rollbar\RollbarService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool to get a single error item by its ID.
 *
 * Returns detailed information about a specific error item including
 * its title, level, status, and occurrence data.
 *
 * Note: The Rollbar API requires the access_token to be passed as a
 * query parameter for this endpoint.
 *
 * @see https://docs.rollbar.com/docs/item
 */
class RollbarGetItem implements Tool
{
    /**
     * Create a new RollbarGetItem tool instance.
     */
    public function __construct(
        private RollbarService $service,
    ) {}

    /**
     * Get the tool name identifier.
     */
    public function name(): string
    {
        return 'rollbar_get_item';
    }

    /**
     * Get the tool description.
     */
    public function description(): string
    {
        return 'Get details for a specific Rollbar error item by its ID.';
    }

    /**
     * Get the tool parameter definitions.
     */
    public function parameters(): array
    {
        return [
            'id' => ['type' => 'integer', 'required' => true, 'description' => 'The item (counter) ID.'],
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
            $result = $this->service->getItem($id);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
