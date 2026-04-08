<?php

namespace OpenCompany\Integrations\HelpScout\Tools;

use OpenCompany\Integrations\HelpScout\HelpScoutService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class HelpScoutListMailboxes implements Tool
{
    /**
     * @param  HelpScoutService  $service  The HelpScout API service instance.
     */
    public function __construct(
        private HelpScoutService $service,
    ) {}

    /**
     * The tool identifier.
     */
    public function name(): string
    {
        return 'helpscout_list_mailboxes';
    }

    /**
     * A description of what the tool does, used by AI agents.
     */
    public function description(): string
    {
        return 'List all mailboxes in HelpScout. Returns mailbox IDs, names, and email addresses. Use mailbox IDs when creating or filtering conversations.';
    }

    /**
     * Parameter schema for the tool.
     *
     * @return array<string, array<string, mixed>>
     */
    public function parameters(): array
    {
        return [
            'page' => ['type' => 'integer', 'description' => 'Page number for pagination (default: 1).'],
            'per_page' => ['type' => 'integer', 'description' => 'Number of results per page (default: 25, max: 50).'],
        ];
    }

    /**
     * Execute the tool call.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     * @return ToolResult
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('HelpScout integration is not configured.');
            }

            $params = array_filter([
                'page' => $args['page'] ?? null,
                'per_page' => $args['per_page'] ?? null,
            ], fn ($value) => $value !== null);

            $result = $this->service->listMailboxes($params);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
