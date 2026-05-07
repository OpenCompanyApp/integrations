<?php

namespace OpenCompany\Integrations\Phantombuster\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List containers for one Phantombuster agent.
 */
class PhantombusterListContainers extends AbstractPhantombusterTool implements Tool
{
    public function name(): string
    {
        return 'phantombuster_list_containers';
    }

    public function description(): string
    {
        return 'List Phantombuster containers (execution runs) for one agent. Returns container IDs, status, timestamps, and optional runtime events.';
    }

    public function parameters(): array
    {
        return [
            'agent_id' => ['type' => 'string', 'required' => true, 'description' => 'Agent ID whose containers should be listed.'],
            'before_ended_at' => ['type' => 'string', 'description' => 'Return containers that ended before this date.'],
            'limit' => ['type' => 'integer', 'description' => 'Maximum number of containers.'],
            'mode' => ['type' => 'string', 'enum' => ['all', 'finalized'], 'description' => 'Return all or only finalized containers.'],
            'with_runtime_events' => ['type' => 'boolean', 'description' => 'Include runtime events.'],
        ];
    }

    /**
     * List containers for an agent.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if ($error = $this->requireConfigured()) {
                return $error;
            }
            if (empty($args['agent_id'])) {
                return ToolResult::error('agent_id is required.');
            }

            $result = $this->service->listContainers((string) $args['agent_id'], $this->only($args, [
                'before_ended_at' => 'beforeEndedAt',
                'limit',
                'mode',
                'with_runtime_events' => 'withRuntimeEvents',
            ]));

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
