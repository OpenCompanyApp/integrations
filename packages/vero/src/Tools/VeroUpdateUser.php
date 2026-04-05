<?php

namespace OpenCompany\Integrations\Vero\Tools;

use OpenCompany\Integrations\Vero\VeroService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class VeroUpdateUser implements Tool
{
    public function __construct(
        private VeroService $service,
    ) {}

    public function name(): string
    {
        return 'vero_update_user';
    }

    public function description(): string
    {
        return 'Update a user\'s profile attributes in Vero. Provide the user\'s identity and a changes object with the attributes to update. Only the specified fields are modified — omitted fields remain unchanged.';
    }

    public function parameters(): array
    {
        return [
            'identity' => ['type' => 'string', 'required' => true, 'description' => 'Unique user identifier — the same ID or email used when identifying the user.'],
            'changes' => ['type' => 'object', 'required' => true, 'description' => 'Key-value pairs of attributes to update (e.g., {"name": "Jane Doe", "plan": "enterprise"}).'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Vero integration is not configured.');
            }

            $identity = $args['identity'];
            $changes = $args['changes'];

            if (is_string($changes)) {
                $changes = json_decode($changes, true) ?? [];
            }

            if (empty($changes)) {
                return ToolResult::error('The changes parameter must contain at least one attribute to update.');
            }

            $result = $this->service->updateUser($identity, $changes);

            return ToolResult::success([
                'message' => "User '{$identity}' updated successfully.",
                'changes' => $changes,
                'data' => $result,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
