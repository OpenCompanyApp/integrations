<?php

namespace OpenCompany\Integrations\Instantly\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Instantly\InstantlyService;

/**
 * Move email accounts between workspaces in the same workspace group.
 *
 * Requires an admin workspace API key and source/destination workspaces under
 * the same admin workspace.
 */
class InstantlyMoveAccounts implements Tool
{
    /**
     * @param  InstantlyService  $service  The Instantly API client
     */
    public function __construct(
        private InstantlyService $service,
    ) {}

    public function name(): string
    {
        return 'instantly_move_accounts';
    }

    public function description(): string
    {
        return 'Move email accounts between workspaces. Requires an admin workspace API key.';
    }

    public function parameters(): array
    {
        return [
            'emails' => ['type' => 'array', 'required' => true, 'description' => 'Email accounts to move', 'items' => ['type' => 'string']],
            'source_workspace_id' => ['type' => 'string', 'required' => true, 'description' => 'Workspace ID the accounts currently belong to'],
            'destination_workspace_id' => ['type' => 'string', 'required' => true, 'description' => 'Workspace ID the accounts should be moved to'],
        ];
    }

    /**
     * Move accounts between workspaces.
     *
     * @param  array<string, mixed>  $args  Tool arguments
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Instantly integration is not configured.');
            }

            $emails = $args['emails'];
            if (is_string($emails)) {
                $emails = array_filter(array_map('trim', explode(',', $emails)));
            }

            $result = $this->service->moveAccounts([
                'emails' => $emails,
                'source_workspace_id' => $args['source_workspace_id'],
                'destination_workspace_id' => $args['destination_workspace_id'],
            ]);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
