<?php

namespace OpenCompany\Integrations\Recruitee\Tools;

use OpenCompany\Integrations\Recruitee\RecruiteeService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class RecruiteeListOffers implements Tool
{
    /**
     * Create a new RecruiteeListOffers tool instance.
     */
    public function __construct(
        private RecruiteeService $service,
    ) {}

    /**
     * Get the tool name (slug).
     */
    public function name(): string
    {
        return 'recruitee_list_offers';
    }

    /**
     * Get the tool description.
     */
    public function description(): string
    {
        return 'List job offers (open positions) from Recruitee. Returns paginated results with offer titles, statuses, and metadata. Filter by status to see only open, closed, or draft positions.';
    }

    /**
     * Get the tool parameter definitions.
     *
     * @return array<string, array<string, mixed>>
     */
    public function parameters(): array
    {
        return [
            'status' => ['type' => 'string', 'description' => 'Filter by offer status: "open", "closed", or "draft". Omit to return all offers.'],
            'page' => ['type' => 'integer', 'description' => 'Page number for pagination (default: 1).'],
            'limit' => ['type' => 'integer', 'description' => 'Number of results per page (default: 20, max: 100).'],
        ];
    }

    /**
     * Execute the tool.
     *
     * @param  array<string, mixed>  $args
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Recruitee integration is not configured.');
            }

            $params = [];

            if (isset($args['status'])) {
                $params['status'] = $args['status'];
            }

            if (isset($args['page'])) {
                $params['page'] = (int) $args['page'];
            }

            if (isset($args['limit'])) {
                $params['limit'] = min((int) $args['limit'], 100);
            }

            $result = $this->service->listOffers($params);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
