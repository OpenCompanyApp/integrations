<?php

namespace OpenCompany\Integrations\Immigrant\Tools;

use OpenCompany\Integrations\Immigrant\ImmigrantService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool: immigrant_list_applications
 *
 * Lists immigration applications from Immigrant with optional filtering
 * by status and pagination support via limit/page parameters.
 */
class ImmigrantListApplications implements Tool
{
    public function __construct(
        private ImmigrantService $service,
    ) {}

    public function name(): string
    {
        return 'immigrant_list_applications';
    }

    public function description(): string
    {
        return 'List immigration applications. Returns a paginated list of applications, optionally filtered by status.';
    }

    public function parameters(): array
    {
        return [
            'limit' => ['type' => 'integer', 'description' => 'Number of applications to return per page (default: 25, max: 100).'],
            'page' => ['type' => 'integer', 'description' => 'Page number for pagination (1-based).'],
            'status' => ['type' => 'string', 'description' => 'Filter applications by status (e.g. "pending", "approved", "rejected").'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Immigrant integration is not configured.');
            }

            $limit = isset($args['limit']) ? (int) $args['limit'] : 25;
            $page = isset($args['page']) ? (int) $args['page'] : 1;
            $status = $args['status'] ?? null;

            $result = $this->service->listApplications($limit, $page, $status);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
