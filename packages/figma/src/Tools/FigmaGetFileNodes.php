<?php

namespace OpenCompany\Integrations\Figma\Tools;

use OpenCompany\Integrations\Figma\FigmaService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Retrieve specific nodes from a Figma file.
 *
 * Returns node data for the given node IDs, with optional
 * depth and geometry parameters.
 */
class FigmaGetFileNodes implements Tool
{
    /**
     * @param  FigmaService  $service  The Figma API client
     */
    public function __construct(
        private FigmaService $service,
    ) {}

    public function name(): string
    {
        return 'figma_get_file_nodes';
    }

    public function description(): string
    {
        return 'Get specific nodes from a Figma file by node IDs.';
    }

    public function parameters(): array
    {
        return [
            'file_key' => ['type' => 'string', 'required' => true, 'description' => 'The Figma file key.'],
            'ids'      => ['type' => 'string', 'required' => true, 'description' => 'Comma-separated list of node IDs to retrieve.'],
            'depth'    => ['type' => 'integer', 'description' => 'Max depth of nodes to return.'],
            'geometry' => ['type' => 'string', 'description' => 'Set to "path" to include vector path data.'],
        ];
    }

    /**
     * Retrieve specific nodes from a Figma file.
     *
     * @param  array<string, mixed>  $args  Tool arguments (file_key, ids, depth, geometry)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Figma integration is not configured.');
            }

            $fileKey = $args['file_key'] ?? '';
            $ids = $args['ids'] ?? '';

            if (empty($fileKey)) {
                return ToolResult::error('file_key is required.');
            }
            if (empty($ids)) {
                return ToolResult::error('ids is required.');
            }

            $params = ['ids' => $ids];

            if (isset($args['depth'])) {
                $params['depth'] = (int) $args['depth'];
            }
            if (! empty($args['geometry'])) {
                $params['geometry'] = $args['geometry'];
            }

            $result = $this->service->getFileNodes($fileKey, $params);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
