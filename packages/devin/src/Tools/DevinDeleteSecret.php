<?php

namespace OpenCompany\Integrations\Devin\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Devin\DevinService;

/**
 * Delete a Devin organization secret.
 *
 * Removes the secret from the configured Devin v3 organization.
 */
class DevinDeleteSecret implements Tool
{
    /**
     * @param  DevinService  $service  The Devin API client.
     */
    public function __construct(
        private DevinService $service,
    ) {}

    public function name(): string
    {
        return 'devin_delete_secret';
    }

    public function description(): string
    {
        return 'Delete a Devin v3 organization secret by ID.';
    }

    public function parameters(): array
    {
        return [
            'secret_id' => ['type' => 'string', 'required' => true, 'description' => 'The Devin secret ID to delete.'],
        ];
    }

    /**
     * Delete the secret.
     *
     * @param  array<string, mixed>  $args  Tool arguments (secret_id).
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Devin integration is not configured.');
            }

            return ToolResult::success($this->service->deleteSecret($args['secret_id']));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
