<?php

namespace OpenCompany\Integrations\Dgraph\Tools;

use OpenCompany\Integrations\Dgraph\DgraphService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Execute a GraphQL mutation to add or update data in Dgraph.
 */
class DgraphMutate implements Tool
{
    /**
     * @param  DgraphService  $service  The Dgraph API client
     */
    public function __construct(
        private DgraphService $service,
    ) {}

    public function name(): string
    {
        return 'dgraph_mutate';
    }

    public function description(): string
    {
        return <<<'MD'
        Execute a GraphQL mutation to add or update data in Dgraph. Provide the
        full GraphQL mutation string and optional variables. Supports all mutation
        operations including add, update, and upsert.
        MD;
    }

    public function parameters(): array
    {
        return [
            'mutation' => ['type' => 'string', 'required' => true, 'description' => 'The GraphQL mutation string to execute.'],
            'variables' => ['type' => 'object', 'description' => 'Optional variables object for the mutation.'],
        ];
    }

    /**
     * Execute a GraphQL mutation.
     *
     * @param  array<string, mixed>  $args  Tool arguments (mutation, variables)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Dgraph integration is not configured.');
            }

            $mutation = $args['mutation'] ?? '';
            if (empty($mutation)) {
                return ToolResult::error('mutation is required.');
            }

            $variables = $args['variables'] ?? [];
            if (is_string($variables)) {
                $variables = json_decode($variables, true);
                if (json_last_error() !== JSON_ERROR_NONE) {
                    return ToolResult::error('Invalid JSON in variables: ' . json_last_error_msg());
                }
            }

            $result = $this->service->mutate($mutation, $variables ?? []);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
