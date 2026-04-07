<?php

namespace OpenCompany\Integrations\Vault\Tools;

use OpenCompany\Integrations\Vault\VaultService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Delete all versions and metadata of a secret from a HashiCorp Vault KV v2 secrets engine.
 */
class VaultDeleteSecret implements Tool
{
    /** @param  VaultService  $service  The Vault API client */
    public function __construct(
        private VaultService $service,
    ) {}

    public function name(): string
    {
        return 'vault_delete_secret';
    }

    public function description(): string
    {
        return 'Permanently delete all versions and metadata of a secret from a HashiCorp Vault KV v2 secrets engine. This action is irreversible.';
    }

    public function parameters(): array
    {
        return [
            'path' => ['type' => 'string', 'required' => true, 'description' => 'The path of the secret to delete (e.g. "myapp/database").'],
            'engine_path' => ['type' => 'string', 'description' => 'The mount path of the KV v2 secrets engine. Default: secret.'],
        ];
    }

    /**
     * Delete a secret from Vault.
     *
     * @param  array<string, mixed>  $args  Tool arguments (path, engine_path)
     */
    public function execute(array $args): ToolResult
    {
        if (! $this->service->isConfigured()) {
            return ToolResult::error('Vault is not configured. Missing token.');
        }

        $path = $args['path'] ?? '';

        if (empty($path)) {
            return ToolResult::error('Secret path is required.');
        }

        try {
            $enginePath = $args['engine_path'] ?? 'secret';

            $result = $this->service->deleteSecret($path, $enginePath);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
