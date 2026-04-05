<?php

namespace OpenCompany\Integrations\Affinity\Tools;

use OpenCompany\Integrations\Affinity\AffinityService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool to list organizations from Affinity CRM.
 *
 * Returns a paginated list of organizations with their names, domains,
 * and other associated details.
 */
class AffinityListOrganizations implements Tool
{
    /**
     * Create a new AffinityListOrganizations tool instance.
     *
     * @param  AffinityService  $service  The Affinity API service.
     */
    public function __construct(
        private AffinityService $service,
    ) {}

    /**
     * The tool name used for registration and invocation.
     */
    public function name(): string
    {
        return 'affinity_list_organizations';
    }

    /**
     * A description of what this tool does, used by AI agents.
     */
    public function description(): string
    {
        return 'List organizations from Affinity CRM. Returns organization names, domains, and details. Use pagination to retrieve large result sets.';
    }

    /**
     * The parameters this tool accepts.
     *
     * @return array<string, array{type: string, description: string, required?: bool}>
     */
    public function parameters(): array
    {
        return [
            'limit' => ['type' => 'integer', 'description' => 'Maximum number of organizations to return (default: 100, max: 500).'],
            'page' => ['type' => 'integer', 'description' => 'Page number for pagination (starts at 1).'],
        ];
    }

    /**
     * Execute the tool and return the result.
     *
     * @param  array<string, mixed>  $args  The tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Affinity integration is not configured.');
            }

            $limit = isset($args['limit']) ? (int) $args['limit'] : 100;
            $page = isset($args['page']) ? (int) $args['page'] : null;

            $result = $this->service->listOrganizations($limit, $page);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
