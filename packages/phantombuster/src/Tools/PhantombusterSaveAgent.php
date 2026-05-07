<?php

namespace OpenCompany\Integrations\Phantombuster\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Create or update a Phantombuster agent.
 */
class PhantombusterSaveAgent extends AbstractPhantombusterTool implements Tool
{
    public function name(): string
    {
        return 'phantombuster_save_agent';
    }

    public function description(): string
    {
        return 'Create or update a Phantombuster agent using official /agents/save fields.';
    }

    public function parameters(): array
    {
        return [
            'id' => ['type' => 'string', 'description' => 'Existing agent ID to update. Omit to create.'],
            'name' => ['type' => 'string', 'description' => 'Agent name.'],
            'script' => ['type' => 'string', 'description' => 'Script ID.'],
            'branch' => ['type' => 'string', 'description' => 'Branch ID.'],
            'environment' => ['type' => 'string', 'enum' => ['staging', 'release'], 'description' => 'Script environment.'],
            'launch_type' => ['type' => 'string', 'enum' => ['manually', 'repeatedly', 'once', 'after agent'], 'description' => 'Launch mode.'],
            'argument' => ['type' => 'object', 'description' => 'Default launch argument.'],
            'payload' => ['type' => 'object', 'description' => 'Additional official /agents/save fields.'],
        ];
    }

    /**
     * Save an agent.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if ($error = $this->requireConfigured()) {
                return $error;
            }

            $payload = $this->payload($args, [
                'id',
                'name',
                'script',
                'branch',
                'environment',
                'launch_type' => 'launchType',
                'argument',
            ]);
            if ($payload === []) {
                return ToolResult::error('At least one agent field or payload value is required.');
            }

            return ToolResult::success($this->service->saveAgent($payload));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
