<?php

namespace OpenCompany\Integrations\Missive\Tools;

use OpenCompany\Integrations\Missive\MissiveService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool: missive_list_conversations
 *
 * List conversations from Missive with optional filters and pagination.
 * Supports filtering by inbox, assignee, and state.
 */
class MissiveListConversations implements Tool
{
    /**
     * @param  MissiveService  $service  The Missive API service instance.
     */
    public function __construct(
        private MissiveService $service,
    ) {}

    /**
     * The tool identifier.
     */
    public function name(): string
    {
        return 'missive_list_conversations';
    }

    /**
     * Human-readable description of what this tool does.
     */
    public function description(): string
    {
        return 'List conversations from Missive. Supports filtering by inbox, assignee, and state. Returns paginated results.';
    }

    /**
     * Define the accepted parameters.
     *
     * @return array<string, array<string, mixed>>
     */
    public function parameters(): array
    {
        return [
            'inbox' => ['type' => 'string', 'description' => 'Filter by inbox ID.'],
            'assignee' => ['type' => 'string', 'description' => 'Filter by assignee user ID or email.'],
            'state' => ['type' => 'string', 'description' => 'Filter by conversation state: "open", "closed", or "spam".'],
            'limit' => ['type' => 'integer', 'description' => 'Maximum number of conversations to return (default: 25, max: 100).'],
            'offset' => ['type' => 'integer', 'description' => 'Offset for pagination.'],
        ];
    }

    /**
     * Execute the tool — list conversations from Missive.
     *
     * @param  array<string, mixed>  $args  The input parameters.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Missive integration is not configured.');
            }

            $params = [];

            if (isset($args['inbox'])) {
                $params['inbox'] = $args['inbox'];
            }
            if (isset($args['assignee'])) {
                $params['assignee'] = $args['assignee'];
            }
            if (isset($args['state'])) {
                $params['state'] = $args['state'];
            }
            if (isset($args['limit'])) {
                $params['limit'] = (int) $args['limit'];
            }
            if (isset($args['offset'])) {
                $params['offset'] = (int) $args['offset'];
            }

            $result = $this->service->listConversations($params);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
