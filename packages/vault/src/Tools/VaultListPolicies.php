<?php

namespace OpenCompany\Integrations\Vault\Tools;

use OpenCompany\Integrations\Vault\VaultService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List all ACL policies in HashiCorp Vault.
 */
class VaultListPolicies implements Tool
{
    /** @param  VaultService  $service  The Vault API client */
    public function __construct(
        private VaultService $service,
    ) {}

    public function name(): string
    {
        return 'vault_list_policies';
    }

    public function description(): string
    {
        return 'List all ACL policies configured in HashiCorp Vault. Returns an array of policy names.';
    }

    public function parameters(): array
    {
        return [];
    }

    /**
     * List all ACL policies.
     *
     * @param  array<string, mixed>  $args  Tool arguments (unused)
     */
    public function execute(array $args): ToolResult
    {
        if (! $this->service->isConfigured()) {
            return ToolResult::error('Vault is not configured. Missing token.');
        }

        try {
            $result = $this->service->listPolicies();

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
