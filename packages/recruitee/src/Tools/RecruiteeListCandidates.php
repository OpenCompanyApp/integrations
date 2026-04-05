<?php

namespace OpenCompany\Integrations\Recruitee\Tools;

use OpenCompany\Integrations\Recruitee\RecruiteeService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class RecruiteeListCandidates implements Tool
{
    /**
     * Create a new RecruiteeListCandidates tool instance.
     */
    public function __construct(
        private RecruiteeService $service,
    ) {}

    /**
     * Get the tool name (slug).
     */
    public function name(): string
    {
        return 'recruitee_list_candidates';
    }

    /**
     * Get the tool description.
     */
    public function description(): string
    {
        return 'List candidates from Recruitee. Returns paginated results with candidate names, emails, and application status.';
    }

    /**
     * Get the tool parameter definitions.
     *
     * @return array<string, array<string, mixed>>
     */
    public function parameters(): array
    {
        return [
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

            if (isset($args['page'])) {
                $params['page'] = (int) $args['page'];
            }

            if (isset($args['limit'])) {
                $params['limit'] = min((int) $args['limit'], 100);
            }

            $result = $this->service->listCandidates($params);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
