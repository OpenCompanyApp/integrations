<?php

namespace OpenCompany\Integrations\MicrosoftTodo\Tools;

use OpenCompany\Integrations\MicrosoftTodo\MicrosoftTodoService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool: Get the currently authenticated Microsoft user profile.
 *
 * Calls `GET /me` on the Microsoft Graph API and returns the user's display name,
 * email address, and other profile information. Useful for verifying the connection
 * and identifying which account the integration is using.
 *
 * @see https://learn.microsoft.com/en-us/graph/api/user-get
 */
class TodoGetCurrentUser implements Tool
{
    /**
     * @param  MicrosoftTodoService  $service  The Microsoft To Do API service.
     */
    public function __construct(
        private MicrosoftTodoService $service,
    ) {}

    /**
     * The machine name of this tool.
     */
    public function name(): string
    {
        return 'todo_get_current_user';
    }

    /**
     * A human-readable description of what this tool does.
     */
    public function description(): string
    {
        return 'Get the authenticated Microsoft user profile. Returns display name, email, and other account details. Useful for verifying which account is connected.';
    }

    /**
     * Parameter schema for this tool.
     *
     * @return array<string, array<string, mixed>>
     */
    public function parameters(): array
    {
        return [];
    }

    /**
     * Execute the tool — fetch the current user profile.
     *
     * @param  array<string, mixed>  $args  Tool arguments (none required).
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Microsoft To Do integration is not configured.');
            }

            $result = $this->service->getCurrentUser();

            return ToolResult::success([
                'id' => $result['id'] ?? null,
                'displayName' => $result['displayName'] ?? null,
                'mail' => $result['mail'] ?? null,
                'userPrincipalName' => $result['userPrincipalName'] ?? null,
                'jobTitle' => $result['jobTitle'] ?? null,
                'officeLocation' => $result['officeLocation'] ?? null,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
