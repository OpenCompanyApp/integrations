<?php

namespace OpenCompany\Integrations\N8n\Tools;

use OpenCompany\Integrations\N8n\N8nService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Create a new n8n workflow.
 */
class N8nCreateWorkflow implements Tool
{
    /** @param  N8nService  $service  The n8n API client */
    public function __construct(
        private N8nService $service,
    ) {}

    public function name(): string
    {
        return 'n8n_create_workflow';
    }

    public function description(): string
    {
        return 'Create a new n8n workflow. Requires a name. Optionally define nodes, connections, and settings.';
    }

    public function parameters(): array
    {
        return [
            'name' => ['type' => 'string', 'required' => true, 'description' => 'The name of the workflow.'],
            'nodes' => ['type' => 'array', 'description' => 'Array of node objects defining the workflow steps.'],
            'connections' => ['type' => 'array', 'description' => 'Connection mappings between nodes.'],
            'settings' => ['type' => 'array', 'description' => 'Workflow settings (e.g. executionOrder, saveManualExecutions, callerPolicy).'],
            'tags' => ['type' => 'array', 'description' => 'Array of tag objects with id and/or name to associate with the workflow.'],
        ];
    }

    /**
     * Create a new workflow.
     *
     * @param  array<string, mixed>  $args  Tool arguments (name, nodes, connections, settings, tags)
     */
    public function execute(array $args): ToolResult
    {
        if (! $this->service->isConfigured()) {
            return ToolResult::error('n8n is not configured. Missing API key.');
        }

        $name = $args['name'] ?? '';

        if (empty($name)) {
            return ToolResult::error('Workflow name is required.');
        }

        try {
            $params = [];

            $mapping = [
                'name' => 'name',
                'nodes' => 'nodes',
                'connections' => 'connections',
                'settings' => 'settings',
                'tags' => 'tags',
            ];

            foreach ($mapping as $argKey => $paramKey) {
                if (isset($args[$argKey])) {
                    $params[$paramKey] = $args[$argKey];
                }
            }

            $result = $this->service->createWorkflow($params);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
