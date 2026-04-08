<?php

namespace OpenCompany\Integrations\Moosend\Tools;

use OpenCompany\Integrations\Moosend\MoosendService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class MoosendListSubscribers implements Tool
{
    /**
     * Create a new MoosendListSubscribers tool instance.
     *
     * @param MoosendService $service The Moosend service instance.
     */
    public function __construct(
        private MoosendService $service,
    ) {}

    /**
     * Get the tool name identifier.
     *
     * @return string
     */
    public function name(): string
    {
        return 'moosend_list_subscribers';
    }

    /**
     * Get the tool description.
     *
     * @return string
     */
    public function description(): string
    {
        return 'List subscribers for a specific mailing list in Moosend. Supports filtering by status and pagination.';
    }

    /**
     * Get the tool parameter definitions.
     *
     * @return array
     */
    public function parameters(): array
    {
        return [
            'list_id' => ['type' => 'string', 'required' => true, 'description' => 'The mailing list ID to retrieve subscribers for.'],
            'limit' => ['type' => 'integer', 'description' => 'Maximum number of subscribers to return (default: 10).'],
            'page' => ['type' => 'integer', 'description' => 'Page number for pagination (default: 1).'],
            'status' => ['type' => 'string', 'description' => 'Filter by subscriber status: "Subscribed", "Unsubscribed", "Bounced", "Removed".'],
        ];
    }

    /**
     * Execute the tool: list subscribers for a specific mailing list.
     *
     * @param array $args The tool arguments (list_id, limit, page, status).
     * @return ToolResult The result containing subscribers or an error message.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Moosend integration is not configured.');
            }

            if (empty($args['list_id'])) {
                return ToolResult::error('The "list_id" parameter is required.');
            }

            $limit = isset($args['limit']) ? (int) $args['limit'] : 10;
            $page = isset($args['page']) ? (int) $args['page'] : 1;
            $status = $args['status'] ?? '';

            $result = $this->service->listSubscribers($args['list_id'], $limit, $page, $status);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
