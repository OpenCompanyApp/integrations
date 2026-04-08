<?php

namespace OpenCompany\Integrations\Splitwise\Tools;

use OpenCompany\Integrations\Splitwise\SplitwiseService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * SplitwiseGetGroup — Retrieve a single group by ID.
 *
 * Returns full group details including name, members, and the
 * current balance state between all members of the group.
 *
 * @see https://dev.splitwise.com/#get_group
 */
class SplitwiseGetGroup implements Tool
{
    /**
     * Create a new SplitwiseGetGroup tool instance.
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
        return 'splitwise_get_group';
    }

    /**
     * Get the tool description shown to AI agents.
     *
     * @return string A human-readable description of what this tool does.
     */
    public function description(): string
    {
        return 'Get detailed information about a specific group in Splitwise, including all members and their current balances.';
    }

    /**
     * Get the tool parameter schema.
     *
     * @return array<string, array{type: string, required?: bool, description: string}> Parameter definitions.
     */
    public function parameters(): array
    {
        return [
            'id' => ['type' => 'integer', 'required' => true, 'description' => 'The group ID to retrieve.'],
        ];
    }

    /**
     * Execute the get group tool.
     *
     * @param  array<string, mixed>  $args  Tool arguments containing the group ID.
     * @return ToolResult The group details or an error message.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Splitwise integration is not configured.');
            }

            if (!isset($args['id'])) {
                return ToolResult::error('Group ID is required.');
            }

            $result = $this->service->getGroup((int) $args['id']);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
