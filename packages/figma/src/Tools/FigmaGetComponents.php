<?php

namespace OpenCompany\Integrations\Figma\Tools;

use OpenCompany\Integrations\Figma\FigmaService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List components in a Figma file.
 *
 * Returns all local components defined in the file.
 */
class FigmaGetComponents implements Tool
{
    /**
     * @param  FigmaService  $service  The Figma API client
     */
    public function __construct(
        private FigmaService $service,
    ) {}

    public function name(): string
    {
        return 'figma_get_components';
    }

    public function description(): string
    {
        return 'List all components in a Figma file.';
    }

    public function parameters(): array
    {
        return [
            'file_key' => ['type' => 'string', 'required' => true, 'description' => 'The Figma file key.'],
        ];
    }

    /**
     * List components in a Figma file.
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

            $result = $this->service->getComponents($fileKey);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
