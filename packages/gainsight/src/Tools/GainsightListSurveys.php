<?php

namespace OpenCompany\Integrations\Gainsight\Tools;

use OpenCompany\Integrations\Gainsight\GainsightService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool for listing surveys from Gainsight.
 *
 * Retrieves surveys from the Gainsight customer success platform
 * with support for filtering by status and pagination.
 */
class GainsightListSurveys implements Tool
{
    /**
     * Create a new GainsightListSurveys tool instance.
     */
    public function __construct(
        private GainsightService $service,
    ) {}

    /**
     * Get the tool name identifier.
     */
    public function name(): string
    {
        return 'gainsight_list_surveys';
    }

    /**
     * Get the tool description for AI agent consumption.
     */
    public function description(): string
    {
        return 'List surveys from Gainsight. Returns survey details including name, type, status, response count, and creation date.';
    }

    /**
     * Get the tool parameter schema.
     *
     * @return array<string, array<string, mixed>>
     */
    public function parameters(): array
    {
        return [
            'page' => ['type' => 'integer', 'description' => 'Page number for pagination (starting from 1).'],
            'limit' => ['type' => 'integer', 'description' => 'Maximum number of surveys to return (default: 50).'],
            'status' => ['type' => 'string', 'description' => 'Filter surveys by status (e.g., "active", "draft", "closed").'],
        ];
    }

    /**
     * Execute the list surveys tool.
     *
     * @param  array  $args  Tool arguments matching the parameter schema.
     * @return ToolResult The result containing survey data or an error message.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Gainsight integration is not configured.');
            }

            $params = [];

            if (isset($args['page'])) {
                $params['page'] = $args['page'];
            }
            if (isset($args['limit'])) {
                $params['limit'] = $args['limit'];
            }
            if (isset($args['status'])) {
                $params['status'] = $args['status'];
            }

            $result = $this->service->listSurveys($params);

            $surveys = $result['surveys'] ?? $result['data'] ?? [];
            $totalCount = count($surveys);
            $response = [
                'surveys' => $surveys,
                'count' => $totalCount,
            ];

            if (isset($result['totalRecords'])) {
                $response['totalRecords'] = $result['totalRecords'];
            }
            if (isset($result['total'])) {
                $response['totalRecords'] = $result['total'];
            }

            return ToolResult::success($response);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
