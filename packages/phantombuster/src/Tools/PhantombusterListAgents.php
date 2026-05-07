<?php

namespace OpenCompany\Integrations\Phantombuster\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List Phantombuster agents in the current organization.
 */
class PhantombusterListAgents extends AbstractPhantombusterTool implements Tool
{
    public function name(): string
    {
        return 'phantombuster_list_agents';
    }

    public function description(): string
    {
        return 'List all Phantombuster agents in your account. Returns agent IDs, names, and status so you can inspect or launch them.';
    }

    public function parameters(): array
    {
        return [
            'input_types' => ['type' => 'array', 'description' => 'Filter by manifest input types.'],
            'output_types' => ['type' => 'array', 'description' => 'Filter by manifest output types.'],
            'agent_ids' => ['type' => 'array', 'description' => 'Limit to up to 100 agent IDs.'],
            'with_argument' => ['type' => 'boolean', 'description' => 'Include default agent arguments.'],
            'with_agent_slots_factor' => ['type' => 'boolean', 'description' => 'Include reserved agent slots factor.'],
        ];
    }

    /**
     * List agents.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if ($error = $this->requireConfigured()) {
                return $error;
            }

            $result = $this->service->listAgents($this->only($args, [
                'input_types' => 'inputTypes',
                'output_types' => 'outputTypes',
                'agent_ids' => 'agentIds',
                'with_argument' => 'withArgument',
                'with_agent_slots_factor' => 'withAgentSlotsFactor',
            ]));

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
