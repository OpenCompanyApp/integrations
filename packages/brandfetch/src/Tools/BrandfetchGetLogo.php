<?php

namespace OpenCompany\Integrations\Brandfetch\Tools;

use OpenCompany\Integrations\Brandfetch\BrandfetchService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get a single logo by its unique identifier.
 *
 * Returns detailed information about a specific logo, including the
 * download URL, format, dimensions, and theme.
 */
class BrandfetchGetLogo implements Tool
{
    public function __construct(
        private BrandfetchService $service,
    ) {}

    public function name(): string
    {
        return 'brandfetch_get_logo';
    }

    public function description(): string
    {
        return 'Get a single logo by its ID. Returns detailed information including download URL, format, dimensions, and theme.';
    }

    public function parameters(): array
    {
        return [
            'id' => ['type' => 'string', 'required' => true, 'description' => 'The unique logo identifier.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Brandfetch integration is not configured.');
            }

            $result = $this->service->getLogo($args['id']);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
