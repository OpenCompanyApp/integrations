<?php

namespace OpenCompany\Integrations\Modal\Tools;

use OpenCompany\Integrations\Modal\ModalService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List all Modal secrets.
 */
class ModalListSecrets implements Tool
{
    public function __construct(
        private ModalService $service,
    ) {}

    public function name(): string
    {
        return 'modal_list_secrets';
    }

    public function description(): string
    {
        return 'List all Modal secrets. Returns secret names and creation dates (values are not exposed).';
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

            $result = $this->service->listSecrets();

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
