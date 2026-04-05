<?php

namespace OpenCompany\Integrations\Figma\Tools;

use OpenCompany\Integrations\Figma\FigmaService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Retrieve a Figma file document by key.
 *
 * Returns the full file structure including pages, frames,
 * and nodes. Supports optional filtering by node IDs and depth.
 */
class FigmaGetFile implements Tool
{
    /**
     * @param  FigmaService  $service  The Figma API client
     */
    public function __construct(
        private FigmaService $service,
    ) {}

    public function name(): string
    {
        return 'figma_get_file';
    }

    public function description(): string
    {
        return 'Get a Figma file by key. Returns the document tree with pages and nodes.';
    }

    public function parameters(): array
    {
        return [
            'file_key'    => ['type' => 'string', 'required' => true, 'description' => 'The Figma file key (from the file URL).'],
            'ids'         => ['type' => 'string', 'description' => 'Comma-separated list of node IDs to return.'],
            'depth'       => ['type' => 'integer', 'description' => 'Max depth of the document tree to return.'],
            'geometry'    => ['type' => 'string', 'description' => 'Set to "path" to include vector path data.'],
            'plugin_data' => ['type' => 'string', 'description' => 'Comma-separated list of plugin IDs to include data for.'],
        ];
    }

    /**
     * Retrieve a Figma file.
     *
     * @param  array<string, mixed>  $args  Tool arguments (file_key, ids, depth, geometry, plugin_data)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Figma integration is not configured.');
            }

            $fileKey = $args['file_key'] ?? '';

            if (empty($fileKey)) {
                return ToolResult::error('file_key is required.');
            }

            $params = [];

            if (! empty($args['ids'])) {
                $params['ids'] = $args['ids'];
            }
            if (isset($args['depth'])) {
                $params['depth'] = (int) $args['depth'];
            }
            if (! empty($args['geometry'])) {
                $params['geometry'] = $args['geometry'];
            }
            if (! empty($args['plugin_data'])) {
                $params['plugin_data'] = $args['plugin_data'];
            }

            $result = $this->service->getFile($fileKey, $params);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
