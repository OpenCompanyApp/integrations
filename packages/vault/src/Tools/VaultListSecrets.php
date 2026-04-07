<?php

namespace OpenCompany\Integrations\Vault\Tools;

use OpenCompany\Integrations\Vault\VaultService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List secrets at a given path in a HashiCorp Vault KV v2 secrets engine.
 */
class VaultListSecrets implements Tool
{
    /** @param  VaultService  $service  The Vault API client */
    public function __construct(
        private VaultService $service,
    ) {}

    public function name(): string
    {
        return 'vault_list_secrets';
    }

    public function description(): string
    {
        return 'List secrets at a given path in a HashiCorp Vault KV v2 secrets engine. Returns the keys (directory entries) at the specified path.';
    }

    public function parameters(): array
    {
        return [
            'engine_path' => ['type' => 'string', 'description' => 'The mount path of the KV v2 secrets engine. Default: secret.'],
            'path' => ['type' => 'string', 'description' => 'The path within the secrets engine to list. Leave empty for root.'],
        ];
    }

    /**
     * List secrets at the specified path.
     *
     * @param  array<string, mixed>  $args  Tool arguments (engine_path, path)
     */
    public function execute(array $args): ToolResult
    {
        if (! $this->service->isConfigured()) {
            return ToolResult::error('Vault is not configured. Missing token.');
        }

        try {
            $enginePath = $args['engine_path'] ?? 'secret';
            $path = $args['path'] ?? '';

            $result = $this->service->listSecrets($enginePath, $path);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
