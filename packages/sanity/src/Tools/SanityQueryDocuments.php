<?php

namespace OpenCompany\Integrations\Sanity\Tools;

use OpenCompany\Integrations\Sanity\SanityService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class SanityQueryDocuments implements Tool
{
    public function __construct(
        private SanityService $service,
    ) {}

    public function name(): string
    {
        return 'sanity_query_documents';
    }

    public function description(): string
    {
        return 'Query documents in Sanity using GROQ (Graph-Relational Object Queries). Returns matching documents with their fields.';
    }

    public function parameters(): array
    {
        return [
            'query' => ['type' => 'string', 'required' => true, 'description' => 'GROQ query string (e.g., `*[_type == "post"]`). See https://www.sanity.io/docs/groq for syntax.'],
            'params' => ['type' => 'object', 'description' => 'Optional parameters referenced in the query as $paramName (e.g., `{"type": "post"}` used as `*[_type == $type]`).'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Sanity integration is not configured.');
            }

            $query = $args['query'] ?? '';
            if (empty($query)) {
                return ToolResult::error('The "query" parameter is required.');
            }

            $params = $args['params'] ?? [];
            $result = $this->service->queryDocuments($query, $params);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
