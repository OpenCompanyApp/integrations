<?php

namespace OpenCompany\Integrations\Contabo\Tools;

use OpenCompany\Integrations\Contabo\ContaboService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class ContaboListSshKeys implements Tool
{
    public function __construct(
        private ContaboService $service,
    ) {}

    public function name(): string
    {
        return 'contabo_list_ssh_keys';
    }

    public function description(): string
    {
        return 'List all registered SSH keys in the Contabo account. Returns key IDs, names, and fingerprints.';
    }

    public function parameters(): array
    {
        return [];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Contabo integration is not configured.');
            }

            $result = $this->service->listSshKeys();

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
