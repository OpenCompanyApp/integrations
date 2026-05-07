<?php

namespace OpenCompany\Integrations\Devin\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Devin\DevinService;

/**
 * Create a Devin organization secret.
 *
 * Stores a value for Devin sessions without exposing that value in later list
 * responses.
 */
class DevinCreateSecret implements Tool
{
    /**
     * @param  DevinService  $service  The Devin API client.
     */
    public function __construct(
        private DevinService $service,
    ) {}

    public function name(): string
    {
        return 'devin_create_secret';
    }

    public function description(): string
    {
        return 'Create a Devin v3 organization secret for use in sessions.';
    }

    public function parameters(): array
    {
        return [
            'type' => ['type' => 'string', 'required' => true, 'enum' => ['cookie', 'key-value', 'totp'], 'description' => 'Secret type accepted by Devin.'],
            'key' => ['type' => 'string', 'required' => true, 'description' => 'Secret key or name.'],
            'value' => ['type' => 'string', 'required' => true, 'description' => 'Secret value to store.'],
            'is_sensitive' => ['type' => 'boolean', 'description' => 'Whether Devin should treat the value as sensitive.'],
            'note' => ['type' => 'string', 'description' => 'Optional note for humans managing the secret.'],
        ];
    }

    /**
     * Create the secret.
     *
     * @param  array<string, mixed>  $args  Tool arguments (type, key, value, optional is_sensitive, note).
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Devin integration is not configured.');
            }

            return ToolResult::success($this->service->createSecret($args));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
