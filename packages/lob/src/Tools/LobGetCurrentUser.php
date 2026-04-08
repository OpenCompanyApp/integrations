<?php

namespace OpenCompany\Integrations\Lob\Tools;

use OpenCompany\Integrations\Lob\LobService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class LobGetCurrentUser implements Tool
{
    public function __construct(
        private LobService $service,
    ) {}

    public function name(): string
    {
        return 'lob_get_current_user';
    }

    public function description(): string
    {
        return 'List saved addresses in the Lob account. Returns all verified addresses that can be used as sender or recipient for letters and postcards.';
    }

    public function parameters(): array
    {
        return [];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Lob integration is not configured.');
            }

            $result = $this->service->listAddresses();

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
