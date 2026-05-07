<?php

namespace OpenCompany\Integrations\Phantombuster\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get one Phantombuster agent.
 */
class PhantombusterGetAgent extends AbstractPhantombusterTool implements Tool
{
    public function name(): string
    {
        return 'phantombuster_get_agent';
    }

    public function description(): string
    {
        return 'Get details for a specific Phantombuster agent, including its configuration, last run status, and output.';
    }

    public function parameters(): array
    {
        return [
            'id' => ['type' => 'string', 'required' => true, 'description' => 'The agent ID (e.g., "1234567890123456789").'],
            'with_manifest' => ['type' => 'boolean', 'description' => 'Include the agent manifest.'],
            'with_agent_object' => ['type' => 'boolean', 'description' => 'Include the agent object.'],
            'with_code' => ['type' => 'boolean', 'description' => 'Include script code when available.'],
            'with_slaves' => ['type' => 'boolean', 'description' => 'Include slave agents.'],
            'with_sub_slaves' => ['type' => 'boolean', 'description' => 'Include nested slave agents.'],
        ];
    }

    /**
     * Fetch an agent by ID.
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
                return ToolResult::error('Agent ID is required.');
            }

            $result = $this->service->getAgent((string) $args['id'], $this->only($args, [
                'with_manifest' => 'withManifest',
                'with_agent_object' => 'withAgentObject',
                'with_code' => 'withCode',
                'with_slaves' => 'withSlaves',
                'with_sub_slaves' => 'withSubSlaves',
            ]));

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
