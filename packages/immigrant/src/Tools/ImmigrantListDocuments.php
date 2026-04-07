<?php

namespace OpenCompany\Integrations\Immigrant\Tools;

use OpenCompany\Integrations\Immigrant\ImmigrantService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool: immigrant_list_documents
 *
 * Lists documents associated with a specific immigration application
 * with pagination support.
 */
class ImmigrantListDocuments implements Tool
{
    public function __construct(
        private ImmigrantService $service,
    ) {}

    public function name(): string
    {
        return 'immigrant_list_documents';
    }

    public function description(): string
    {
        return 'List documents for a specific immigration application. Returns a paginated list of documents.';
    }

    public function parameters(): array
    {
        return [
            'application_id' => ['type' => 'string', 'required' => true, 'description' => 'The Immigrant application ID to list documents for.'],
            'limit' => ['type' => 'integer', 'description' => 'Number of documents to return per page (default: 25, max: 100).'],
            'page' => ['type' => 'integer', 'description' => 'Page number for pagination (1-based).'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Immigrant integration is not configured.');
            }

            $applicationId = (string) $args['application_id'];
            $limit = isset($args['limit']) ? (int) $args['limit'] : 25;
            $page = isset($args['page']) ? (int) $args['page'] : 1;

            $result = $this->service->listDocuments($applicationId, $limit, $page);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
