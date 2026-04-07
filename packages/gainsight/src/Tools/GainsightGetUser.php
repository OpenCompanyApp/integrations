<?php

namespace OpenCompany\Integrations\Gainsight\Tools;

use OpenCompany\Integrations\Gainsight\GainsightService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool for retrieving detailed information about a specific Gainsight user.
 *
 * Fetches full user profile including role, permissions, assigned
 * accounts, and activity data.
 */
class GainsightGetUser implements Tool
{
    /**
     * Create a new GainsightGetUser tool instance.
     */
    public function __construct(
        private GainsightService $service,
    ) {}

    /**
     * Get the tool name identifier.
     */
    public function name(): string
    {
        return 'gainsight_get_user';
    }

    /**
     * Get the tool description for AI agent consumption.
     */
    public function description(): string
    {
        return 'Get detailed information about a specific user in Gainsight, including role, assigned accounts, and activity data.';
    }

    /**
     * Get the tool parameter schema.
     *
     * @return array<string, array<string, mixed>>
     */
    public function parameters(): array
    {
        return [
            'userId' => ['type' => 'string', 'required' => true, 'description' => 'The unique user identifier (Gainsight User ID).'],
        ];
    }

    /**
     * Execute the get user tool.
     *
     * @param  array  $args  Tool arguments containing the userId.
     * @return ToolResult The result containing user details or an error message.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Gainsight integration is not configured.');
            }

            $result = $this->service->getUser($args['userId']);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
