<?php

namespace OpenCompany\Integrations\Phantombuster\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Fetch incremental output for an agent.
 */
class PhantombusterFetchAgentOutput extends AbstractPhantombusterTool implements Tool
{
    public function name(): string
    {
        return 'phantombuster_fetch_agent_output';
    }

    public function description(): string
    {
        return 'Fetch output from the latest relevant container of a Phantombuster agent.';
    }

    public function parameters(): array
    {
        return [
            'id' => ['type' => 'string', 'required' => true, 'description' => 'Agent ID.'],
            'from_output_pos' => ['type' => 'number', 'description' => 'Start output from this position.'],
            'prev_container_id' => ['type' => 'string', 'description' => 'Previously seen container ID.'],
            'prev_status' => ['type' => 'string', 'description' => 'Previously seen status.'],
            'prev_runtime_event_index' => ['type' => 'number', 'description' => 'Runtime event index to continue from.'],
        ];
    }

    /**
     * Fetch agent output.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if ($error = $this->requireConfigured()) {
                return $error;
            }
            if (empty($args['id'])) {
                return ToolResult::error('id is required.');
            }

            return ToolResult::success($this->service->fetchAgentOutput((string) $args['id'], $this->only($args, [
                'from_output_pos' => 'fromOutputPos',
                'prev_container_id' => 'prevContainerId',
                'prev_status' => 'prevStatus',
                'prev_runtime_event_index' => 'prevRuntimeEventIndex',
            ])));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
