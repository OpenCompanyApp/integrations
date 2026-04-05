<?php

namespace OpenCompany\Integrations\Aircall\Tools;

use OpenCompany\Integrations\Aircall\AircallService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool for listing users from the Aircall API.
 *
 * Returns all users in the Aircall account with their details including
 * name, email, availability status, and assigned phone numbers.
 *
 * @see https://developer.aircall.io/api-references/#list-users
 */
class AircallListUsers implements Tool
{
    /**
     * Create a new AircallListUsers tool instance.
     *
     * @param  AircallService  $service  The Aircall API service instance.
     */
    public function __construct(
        private AircallService $service,
    ) {}

    /**
     * Get the tool name identifier.
     */
    public function name(): string
    {
        return 'aircall_list_users';
    }

    /**
     * Get the tool description for AI agents.
     */
    public function description(): string
    {
        return 'List all users in the Aircall account. Returns user details including name, email, availability, and assigned phone numbers.';
    }

    /**
     * Get the tool parameter definitions.
     *
     * @return array<string, array<string, mixed>>
     */
    public function parameters(): array
    {
        return [];
    }

    /**
     * Execute the list users tool.
     *
     * @param  array  $args  No parameters required.
     * @return ToolResult The result containing user records or an error message.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Aircall integration is not configured.');
            }

            $result = $this->service->listUsers();

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
