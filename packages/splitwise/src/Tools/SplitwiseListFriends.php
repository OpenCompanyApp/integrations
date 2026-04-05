<?php

namespace OpenCompany\Integrations\Splitwise\Tools;

use OpenCompany\Integrations\Splitwise\SplitwiseService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * SplitwiseListFriends — List all friends of the current user.
 *
 * Returns the authenticated user's friend list including each friend's
 * name, email, and the current balance between the user and that friend.
 *
 * @see https://dev.splitwise.com/#get_friends
 */
class SplitwiseListFriends implements Tool
{
    /**
     * Create a new SplitwiseListFriends tool instance.
     *
     * @param  SplitwiseService  $service  The Splitwise API service.
     */
    public function __construct(
        private SplitwiseService $service,
    ) {}

    /**
     * Get the tool name used for registration and invocation.
     *
     * @return string The tool identifier.
     */
    public function name(): string
    {
        return 'splitwise_list_friends';
    }

    /**
     * Get the tool description shown to AI agents.
     *
     * @return string A human-readable description of what this tool does.
     */
    public function description(): string
    {
        return 'List all friends on Splitwise with their current balance information. Shows how much you owe or are owed by each friend.';
    }

    /**
     * Get the tool parameter schema.
     *
     * @return array<string, array{type: string, required?: bool, description: string}> Parameter definitions.
     */
    public function parameters(): array
    {
        return [];
    }

    /**
     * Execute the list friends tool.
     *
     * @param  array<string, mixed>  $args  Tool arguments (none required).
     * @return ToolResult The list of friends or an error message.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Splitwise integration is not configured.');
            }

            $result = $this->service->listFriends();

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
