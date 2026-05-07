<?php

namespace OpenCompany\Integrations\Vero\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Vero\VeroService;

/**
 * Alias a Vero user from one identifier to another.
 *
 * Uses the advanced reidentify endpoint, which merges the old identity into
 * the new identity and can affect historical profile data.
 */
class VeroAliasUser implements Tool
{
    /**
     * @param  VeroService  $service  The Vero API service instance.
     */
    public function __construct(
        private VeroService $service,
    ) {}

    public function name(): string
    {
        return 'vero_alias_user';
    }

    public function description(): string
    {
        return 'Change a Vero user identifier with the official alias endpoint. This merges identities and should be used carefully.';
    }

    public function parameters(): array
    {
        return [
            'id' => ['type' => 'string', 'required' => true, 'description' => 'Existing user identifier.'],
            'new_id' => ['type' => 'string', 'required' => true, 'description' => 'Replacement user identifier.'],
        ];
    }

    /**
     * Execute the alias user tool.
     *
     * @param  array<string, mixed>  $args  Tool arguments (id, new_id).
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Vero integration is not configured.');
            }

            $id = $args['id'] ?? '';
            $newId = $args['new_id'] ?? '';

            if ($id === '') {
                return ToolResult::error('User ID is required.');
            }

            if ($newId === '') {
                return ToolResult::error('New user ID is required.');
            }

            $result = $this->service->aliasUser($id, $newId);

            return ToolResult::success([
                'id' => $id,
                'new_id' => $newId,
                'status' => $result['status'] ?? 200,
                'message' => $result['message'] ?? 'aliased',
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
