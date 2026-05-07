<?php

namespace OpenCompany\Integrations\ManyChat\Tools;

use OpenCompany\Integrations\ManyChat\ManyChatService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List all flows (pages) in the ManyChat account.
 *
 * Returns an overview of all automation flows configured in ManyChat,
 * including flow IDs, names, and status.
 */
class ManyChatListFlows implements Tool
{
    /**
     * @param  ManyChatService  $service  The Manychat API client.
     */
    public function __construct(
        private ManyChatService $service,
    ) {}

    public function name(): string
    {
        return 'manychat_list_flows';
    }

    public function description(): string
    {
        return 'List all flows (pages) in your ManyChat account. Returns flow IDs and names that can be used with get_flow.';
    }

    public function parameters(): array
    {
        return [];
    }

    /**
     * List bot flows from the official getFlows endpoint.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('ManyChat integration is not configured.');
            }

            $result = $this->service->listFlows();

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
