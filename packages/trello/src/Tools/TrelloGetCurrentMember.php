<?php

namespace OpenCompany\Integrations\Trello\Tools;

use OpenCompany\Integrations\Trello\TrelloService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get the currently authenticated Trello member.
 */
class TrelloGetCurrentMember implements Tool
{
    /**
     * @param  TrelloService  $service  The Trello API client
     */
    public function __construct(
        private TrelloService $service,
    ) {}

    public function name(): string
    {
        return 'trello_get_current_member';
    }

    public function description(): string
    {
        return 'Get the currently authenticated Trello member.';
    }

    public function parameters(): array
    {
        return [];
    }

    /**
     * Retrieve the profile of the authenticated member.
     *
     * @param  array<string, mixed>  $args  Tool arguments (none)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Trello integration is not configured.');
            }

            $member = $this->service->getCurrentMember();

            return ToolResult::success($member);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
