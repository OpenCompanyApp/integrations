<?php

namespace OpenCompany\Integrations\Modal\Tools;

use OpenCompany\Integrations\Modal\ModalService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List all Modal volumes.
 */
class ModalListVolumes implements Tool
{
    public function __construct(
        private ModalService $service,
    ) {}

    public function name(): string
    {
        return 'modal_list_volumes';
    }

    public function description(): string
    {
        return 'List all Modal volumes. Returns volume IDs, names, and size details.';
    }

    public function parameters(): array
    {
        return [];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Modal integration is not configured.');
            }

            $result = $this->service->listVolumes();

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
