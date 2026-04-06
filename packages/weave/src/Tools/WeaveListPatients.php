<?php

namespace OpenCompany\Integrations\Weave\Tools;

use OpenCompany\Integrations\Weave\WeaveService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List and search patients in the Weave platform.
 *
 * Supports pagination and full-text search. Returns patient records
 * including names, contact details, and associated metadata.
 */
class WeaveListPatients implements Tool
{
    public function __construct(
        private WeaveService $service,
    ) {}

    public function name(): string
    {
        return 'weave_list_patients';
    }

    public function description(): string
    {
        return 'Search and list patients from Weave. Returns patient records with names, contact info, and metadata. Use the query parameter to search by name, phone, or email.';
    }

    public function parameters(): array
    {
        return [
            'limit' => ['type' => 'integer', 'description' => 'Maximum number of patients to return (default: 25).'],
            'page' => ['type' => 'integer', 'description' => 'Page number for pagination, 1-based (default: 1).'],
            'query' => ['type' => 'string', 'description' => 'Search query to filter patients by name, phone, or email.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Weave integration is not configured.');
            }

            $limit = isset($args['limit']) ? (int) $args['limit'] : 25;
            $page = isset($args['page']) ? (int) $args['page'] : 1;
            $query = $args['query'] ?? null;

            $result = $this->service->listPatients($limit, $page, $query);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
