<?php

namespace OpenCompany\Integrations\Vault\Tools;

use OpenCompany\Integrations\Vault\VaultService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Create or update a secret in a HashiCorp Vault KV v2 secrets engine.
 */
class VaultCreateSecret implements Tool
{
    /** @param  VaultService  $service  The Vault API client */
    public function __construct(
        private VaultService $service,
    ) {}

    public function name(): string
    {
        return 'vault_create_secret';
    }

    public function description(): string
    {
        return 'Create or update a secret in a HashiCorp Vault KV v2 secrets engine. Provide the secret path and a key-value data object.';
    }

    public function parameters(): array
    {
        return [
            'path' => ['type' => 'string', 'required' => true, 'description' => 'The path where the secret will be stored (e.g. "myapp/database").'],
            'data' => ['type' => 'object', 'required' => true, 'description' => 'Key-value pairs for the secret data. Example: {"username": "admin", "password": "s3cret"}.'],
            'engine_path' => ['type' => 'string', 'description' => 'The mount path of the KV v2 secrets engine. Default: secret.'],
        ];
    }

    /**
     * Create or update a secret in Vault.
     *
     * @param  array<string, mixed>  $args  Tool arguments (path, data, engine_path)
     */
    public function execute(array $args): ToolResult
    {
        if (! $this->service->isConfigured()) {
            return ToolResult::error('Vault is not configured. Missing token.');
        }

        $path = $args['path'] ?? '';
        $data = $args['data'] ?? [];

        if (empty($path)) {
            return ToolResult::error('Secret path is required.');
        }

        if (empty($data) || ! is_array($data)) {
            return ToolResult::error('Secret data must be a non-empty key-value object.');
        }

        try {
            $enginePath = $args['engine_path'] ?? 'secret';

            $result = $this->service->createSecret($path, $data, $enginePath);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
