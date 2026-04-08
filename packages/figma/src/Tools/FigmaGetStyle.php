<?php

namespace OpenCompany\Integrations\Figma\Tools;

use OpenCompany\Integrations\Figma\FigmaService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get a Figma style by key.
 *
 * Returns metadata for a single published style
 * including its name, type, and description.
 */
class FigmaGetStyle implements Tool
{
    /**
     * @param  FigmaService  $service  The Figma API client
     */
    public function __construct(
        private FigmaService $service,
    ) {}

    public function name(): string
    {
        return 'figma_get_style';
    }

    public function description(): string
    {
        return 'Get a Figma style by its key.';
    }

    public function parameters(): array
    {
        return [
            'style_key' => ['type' => 'string', 'required' => true, 'description' => 'The style key.'],
        ];
    }

    /**
     * Get a Figma style by key.
     *
     * @param  array<string, mixed>  $args  Tool arguments (style_key)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Figma integration is not configured.');
            }

            $styleKey = $args['style_key'] ?? '';

            if (empty($styleKey)) {
                return ToolResult::error('style_key is required.');
            }

            $result = $this->service->getStyle($styleKey);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
