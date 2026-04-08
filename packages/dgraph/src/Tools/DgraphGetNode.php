<?php

namespace OpenCompany\Integrations\Dgraph\Tools;

use OpenCompany\Integrations\Dgraph\DgraphService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get a specific node by type and ID.
 */
class DgraphGetNode implements Tool
{
    /**
     * @param  DgraphService  $service  The Dgraph API client
     */
    public function __construct(
        private DgraphService $service,
    ) {}

    public function name(): string
    {
        return 'dgraph_get_node';
    }

    public function description(): string
    {
        return <<<'MD'
        Get a specific node from Dgraph by providing its type and ID. Returns
        the node data including all populated fields. Use the type name as defined
        in your GraphQL schema.
        MD;
    }

    public function parameters(): array
    {
        return [
            'type' => ['type' => 'string', 'required' => true, 'description' => 'The GraphQL type of the node (e.g., "User", "Post").'],
            'id' => ['type' => 'string', 'required' => true, 'description' => 'The unique ID of the node to retrieve.'],
        ];
    }

    /**
     * Get a node by type and ID.
     *
     * @param  array<string, mixed>  $args  Tool arguments (type, id)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Dgraph integration is not configured.');
            }

            $type = $args['type'] ?? '';
            $id = $args['id'] ?? '';

            if (empty($type)) {
                return ToolResult::error('type is required.');
            }
            if (empty($id)) {
                return ToolResult::error('id is required.');
            }

            $result = $this->service->getNode($type, $id);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
