<?php

namespace OpenCompany\Integrations\Pinterest\Tools;

use OpenCompany\Integrations\Pinterest\PinterestService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get a single Pinterest pin by ID.
 *
 * Retrieves full details for a specific pin, including title,
 * description, media, board assignment, and link.
 */
class PinterestGetPin implements Tool
{
    public function __construct(
        private PinterestService $service,
    ) {}

    public function name(): string
    {
        return 'pinterest_get_pin';
    }

    public function description(): string
    {
        return 'Get details of a specific Pinterest pin by its ID. Returns the pin title, description, image, board, and link.';
    }

    public function parameters(): array
    {
        return [
            'pinId' => ['type' => 'string', 'required' => true, 'description' => 'The pin ID to retrieve.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Pinterest integration is not configured.');
            }

            $result = $this->service->getPin($args['pinId']);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
