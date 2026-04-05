<?php

namespace OpenCompany\Integrations\Figma\Tools;

use OpenCompany\Integrations\Figma\FigmaService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Retrieve image fill metadata for a Figma file.
 *
 * Returns a mapping from image node IDs to image URLs for
 * all image fills used in the file.
 */
class FigmaGetImageFills implements Tool
{
    /**
     * @param  FigmaService  $service  The Figma API client
     */
    public function __construct(
        private FigmaService $service,
    ) {}

    public function name(): string
    {
        return 'figma_get_image_fills';
    }

    public function description(): string
    {
        return 'Get image fill metadata for a Figma file. Returns image URLs for all image fills.';
    }

    public function parameters(): array
    {
        return [
            'file_key' => ['type' => 'string', 'required' => true, 'description' => 'The Figma file key.'],
        ];
    }

    /**
     * Get image fills for a Figma file.
     *
     * @param  array<string, mixed>  $args  Tool arguments (file_key)
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

            $result = $this->service->getImageFills($fileKey);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
