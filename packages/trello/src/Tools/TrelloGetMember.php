<?php

namespace OpenCompany\Integrations\Trello\Tools;

use OpenCompany\Integrations\Trello\TrelloService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get a Trello member by ID or username.
 */
class TrelloGetMember implements Tool
{
    /**
     * @param  TrelloService  $service  The Trello API client
     */
    public function __construct(
        private TrelloService $service,
    ) {}

    public function name(): string
    {
        return 'trello_get_member';
    }

    public function description(): string
    {
        return 'Get a Trello member by ID or username.';
    }

    public function parameters(): array
    {
        return [
            'id' => ['type' => 'string', 'required' => true, 'description' => 'Member ID or username.'],
        ];
    }

    /**
     * Retrieve a member's profile by their ID or username.
     *
     * @param  array<string, mixed>  $args  Tool arguments (id)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Trello integration is not configured.');
            }

            $id = $args['id'] ?? '';

            if (empty($id)) {
                return ToolResult::error('id is required.');
            }

            $member = $this->service->getMember($id);

            return ToolResult::success($member);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
