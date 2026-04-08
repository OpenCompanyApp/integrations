<?php

namespace OpenCompany\Integrations\Vault\Tools;

use OpenCompany\Integrations\Vault\VaultService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Look up the current Vault token's information.
 */
class VaultGetCurrentUser implements Tool
{
    /** @param  VaultService  $service  The Vault API client */
    public function __construct(
        private VaultService $service,
    ) {}

    public function name(): string
    {
        return 'vault_get_current_user';
    }

    public function description(): string
    {
        return 'Look up the current Vault token\'s information, including display name, policies, TTL, and metadata.';
    }

    public function parameters(): array
    {
        return [];
    }

    /**
     * Retrieve the current token's information.
     *
     * @param  array<string, mixed>  $args  Tool arguments (unused)
     */
    public function execute(array $args): ToolResult
    {
        if (! $this->service->isConfigured()) {
            return ToolResult::error('Vault is not configured. Missing token.');
        }

        try {
            $result = $this->service->getCurrentUser();

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
