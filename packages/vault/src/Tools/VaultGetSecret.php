<?php

namespace OpenCompany\Integrations\Vault\Tools;

use OpenCompany\Integrations\Vault\VaultService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get the latest version of a secret from a HashiCorp Vault KV v2 secrets engine.
 */
class VaultGetSecret implements Tool
{
    /** @param  VaultService  $service  The Vault API client */
    public function __construct(
        private VaultService $service,
    ) {}

    public function name(): string
    {
        return 'vault_get_secret';
    }

    public function description(): string
    {
        return 'Get the latest version of a secret from a HashiCorp Vault KV v2 secrets engine. Optionally specify a version number to retrieve a specific version.';
    }

    public function parameters(): array
    {
        return [
            'path' => ['type' => 'string', 'required' => true, 'description' => 'The path of the secret to retrieve (e.g. "myapp/database").'],
            'engine_path' => ['type' => 'string', 'description' => 'The mount path of the KV v2 secrets engine. Default: secret.'],
            'version' => ['type' => 'integer', 'description' => 'The version number to retrieve. Defaults to the latest version.'],
        ];
    }

    /**
     * Retrieve a secret from Vault.
     *
     * @param  array<string, mixed>  $args  Tool arguments (path, engine_path, version)
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
            $version = $args['version'] ?? null;

            $result = $this->service->getSecret($path, $enginePath, $version);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
