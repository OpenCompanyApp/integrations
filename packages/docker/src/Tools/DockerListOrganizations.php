<?php

namespace OpenCompany\Integrations\Docker\Tools;

use OpenCompany\Integrations\Docker\DockerService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List Docker Hub organizations the authenticated user belongs to.
 *
 * Returns a paginated list of organizations with their names and roles.
 */
class DockerListOrganizations implements Tool
{
    public function __construct(
        private DockerService $service,
    ) {}

    public function name(): string
    {
        return 'docker_list_organizations';
    }

    public function description(): string
    {
        return 'List Docker Hub organizations the authenticated user belongs to. Supports pagination with page_size and page parameters.';
    }

    public function parameters(): array
    {
        return [
            'page_size' => ['type' => 'integer', 'description' => 'Number of organizations per page (default: 25).'],
            'page' => ['type' => 'integer', 'description' => 'Page number for pagination (1-indexed, default: 1).'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Docker Hub integration is not configured.');
            }

            $pageSize = isset($args['page_size']) ? (int) $args['page_size'] : 25;
            $page = isset($args['page']) ? (int) $args['page'] : 1;

            $result = $this->service->listOrganizations($pageSize, $page);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
