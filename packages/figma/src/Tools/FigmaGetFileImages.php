<?php

namespace OpenCompany\Integrations\Figma\Tools;

use OpenCompany\Integrations\Figma\FigmaService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Export images from a Figma file.
 *
 * Renders nodes to images in the specified format (PNG, JPG, SVG, PDF)
 * and returns URLs for downloading.
 */
class FigmaGetFileImages implements Tool
{
    /**
     * @param  FigmaService  $service  The Figma API client
     */
    public function __construct(
        private FigmaService $service,
    ) {}

    public function name(): string
    {
        return 'figma_get_file_images';
    }

    public function description(): string
    {
        return 'Export images from Figma nodes in a file. Returns image download URLs.';
    }

    public function parameters(): array
    {
        return [
            'file_key'              => ['type' => 'string', 'required' => true, 'description' => 'The Figma file key.'],
            'ids'                   => ['type' => 'string', 'required' => true, 'description' => 'Comma-separated list of node IDs to export.'],
            'format'                => ['type' => 'string', 'description' => 'Image format: png, jpg, svg, or pdf. Defaults to png.'],
            'scale'                 => ['type' => 'number', 'description' => 'Image scale factor (e.g. 1, 2, 3). Defaults to 1.'],
            'svg_include_id_token'  => ['type' => 'boolean', 'description' => 'If true, include id attribute for SVG root.'],
        ];
    }

    /**
     * Export images from a Figma file.
     *
     * @param  array<string, mixed>  $args  Tool arguments (file_key, ids, format, scale, svg_include_id_token)
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

            if (! empty($args['format'])) {
                $params['format'] = $args['format'];
            }
            if (isset($args['scale'])) {
                $params['scale'] = (float) $args['scale'];
            }
            if (isset($args['svg_include_id_token'])) {
                $params['svg_include_id_token'] = (bool) $args['svg_include_id_token'];
            }

            $result = $this->service->getFileImages($fileKey, $params);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
