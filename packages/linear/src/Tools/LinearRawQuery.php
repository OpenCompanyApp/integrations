<?php

namespace OpenCompany\Integrations\Linear\Tools;

use OpenCompany\Integrations\Linear\LinearService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Execute an arbitrary GraphQL query or mutation against the Linear API.
 */
class LinearRawQuery implements Tool
{
    /**
     * @param  LinearService  $service  The Linear API client
     */
    public function __construct(
        private LinearService $service,
    ) {}

    public function name(): string
    {
        return 'linear_raw_query';
    }

    public function description(): string
    {
        return <<<'MD'
        Execute an arbitrary GraphQL query or mutation against the Linear API.
        Provide a GraphQL document and optional variables as JSON.
        Use this for advanced operations not covered by other tools.
        MD;
    }

    public function parameters(): array
    {
        return [
            'query' => ['type' => 'string', 'required' => true, 'description' => 'GraphQL query or mutation document.'],
            'variables' => ['type' => 'string', 'description' => 'Variables as a JSON object string.'],
        ];
    }

    /**
     * Execute an arbitrary GraphQL query against the Linear API.
     *
     * @param  array<string, mixed>  $args  Tool arguments
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Linear integration is not configured.');
            }

            $query = $args['query'] ?? '';
            if (empty($query)) {
                return ToolResult::error('query is required.');
            }

            $variables = [];
            if (! empty($args['variables'])) {
                $vars = $args['variables'];
                if (is_string($vars)) {
                    $decoded = json_decode($vars, true);
                    if (json_last_error() !== JSON_ERROR_NONE) {
                        return ToolResult::error('Invalid JSON in variables: ' . json_last_error_msg());
                    }
                    $variables = $decoded;
                } elseif (is_array($vars)) {
                    $variables = $vars;
                }
            }

            $result = $this->service->rawQuery($query, $variables);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
