<?php

namespace OpenCompany\Integrations\Moosend\Tools;

use OpenCompany\Integrations\Moosend\MoosendService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class MoosendListCampaigns implements Tool
{
    /**
     * Create a new MoosendListCampaigns tool instance.
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
        return 'moosend_list_campaigns';
    }

    /**
     * Get the tool description.
     *
     * @return string
     */
    public function description(): string
    {
        return 'List all email campaigns in your Moosend account. Supports filtering by status and pagination.';
    }

    /**
     * Get the tool parameter definitions.
     *
     * @return array
     */
    public function parameters(): array
    {
        return [
            'limit' => ['type' => 'integer', 'description' => 'Maximum number of campaigns to return (default: 10).'],
            'page' => ['type' => 'integer', 'description' => 'Page number for pagination (default: 1).'],
            'status' => ['type' => 'string', 'description' => 'Filter by campaign status: "Sent", "Draft", "Scheduled", "Sending".'],
        ];
    }

    /**
     * Execute the tool: list all campaigns from Moosend.
     *
     * @param array $args The tool arguments (limit, page, status).
     * @return ToolResult The result containing campaigns or an error message.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Moosend integration is not configured.');
            }

            $limit = isset($args['limit']) ? (int) $args['limit'] : 10;
            $page = isset($args['page']) ? (int) $args['page'] : 1;
            $status = $args['status'] ?? '';

            $result = $this->service->listCampaigns($limit, $page, $status);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
