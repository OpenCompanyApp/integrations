<?php

namespace OpenCompany\Integrations\Podio\Tools;

use OpenCompany\Integrations\Podio\PodioService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get details of a specific Podio workspace.
 *
 * Returns full space details including name, description, URL, members, and settings.
 */
class PodioGetSpace implements Tool
{
    public function __construct(
        private PodioService $service,
    ) {}

    public function name(): string
    {
        return 'podio_get_space';
    }

    public function description(): string
    {
        return 'Get detailed information about a specific Podio workspace, including its name, description, URL, and settings. Use the space ID obtained from podio_list_spaces.';
    }

    public function parameters(): array
    {
        return [
            'space_id' => ['type' => 'integer', 'required' => true, 'description' => 'The Podio space (workspace) ID.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Podio integration is not configured.');
            }

            $spaceId = (int) $args['space_id'];
            $space = $this->service->getSpace($spaceId);

            return ToolResult::success($space);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
