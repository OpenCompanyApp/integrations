<?php

namespace OpenCompany\Integrations\Braze\Tools;

use OpenCompany\Integrations\Braze\BrazeService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get detailed information about a specific Braze canvas.
 *
 * Returns the full canvas configuration including steps, targeting,
 * messaging channels, and conversion tracking.
 *
 * @see https://www.braze.com/docs/api/endpoints/export/canvas/get_canvas_details/
 */
class BrazeGetCanvas implements Tool
{
    public function __construct(
        private BrazeService $service,
    ) {}

    public function name(): string
    {
        return 'braze_get_canvas';
    }

    public function description(): string
    {
        return 'Get detailed information about a specific Braze canvas, including steps, targeting rules, messaging channels, and analytics.';
    }

    public function parameters(): array
    {
        return [
            'canvas_id' => ['type' => 'string', 'required' => true, 'description' => 'The Braze canvas identifier.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Braze integration is not configured.');
            }

            if (empty($args['canvas_id'])) {
                return ToolResult::error('canvas_id is required.');
            }

            $result = $this->service->getCanvas($args['canvas_id']);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
