<?php

namespace OpenCompany\Integrations\Figma\Tools;

use OpenCompany\Integrations\Figma\FigmaService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get a Figma component by key.
 *
 * Returns metadata for a single published component
 * including its name, description, and thumbnail.
 */
class FigmaGetComponent implements Tool
{
    /**
     * @param  FigmaService  $service  The Figma API client
     */
    public function __construct(
        private FigmaService $service,
    ) {}

    public function name(): string
    {
        return 'figma_get_component';
    }

    public function description(): string
    {
        return 'Get a Figma component by its key.';
    }

    public function parameters(): array
    {
        return [
            'component_key' => ['type' => 'string', 'required' => true, 'description' => 'The component key.'],
        ];
    }

    /**
     * Get a Figma component by key.
     *
     * @param  array<string, mixed>  $args  Tool arguments (component_key)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Figma integration is not configured.');
            }

            $componentKey = $args['component_key'] ?? '';

            if (empty($componentKey)) {
                return ToolResult::error('component_key is required.');
            }

            $result = $this->service->getComponent($componentKey);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
