<?php

namespace OpenCompany\Integrations\Vault\Tools;

use OpenCompany\Integrations\Vault\VaultService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get details of a specific ACL policy in HashiCorp Vault.
 */
class VaultGetPolicy implements Tool
{
    /** @param  VaultService  $service  The Vault API client */
    public function __construct(
        private VaultService $service,
    ) {}

    public function name(): string
    {
        return 'vault_get_policy';
    }

    public function description(): string
    {
        return 'Get details of a specific ACL policy in HashiCorp Vault, including its name and HCL rules.';
    }

    public function parameters(): array
    {
        return [
            'name' => ['type' => 'string', 'required' => true, 'description' => 'The name of the ACL policy to retrieve.'],
        ];
    }

    /**
     * Retrieve a specific ACL policy.
     *
     * @param  array<string, mixed>  $args  Tool arguments (name)
     */
    public function execute(array $args): ToolResult
    {
        if (! $this->service->isConfigured()) {
            return ToolResult::error('Vault is not configured. Missing token.');
        }

        $name = $args['name'] ?? '';

        if (empty($name)) {
            return ToolResult::error('Policy name is required.');
        }

        try {
            $result = $this->service->getPolicy($name);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
