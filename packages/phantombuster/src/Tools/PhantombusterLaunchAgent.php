<?php

namespace OpenCompany\Integrations\Phantombuster\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Launch a Phantombuster agent.
 */
class PhantombusterLaunchAgent extends AbstractPhantombusterTool implements Tool
{
    public function name(): string
    {
        return 'phantombuster_launch_agent';
    }

    public function description(): string
    {
        return 'Launch a Phantombuster agent to start an automation. Returns the container ID for tracking execution progress.';
    }

    public function parameters(): array
    {
        return [
            'id' => ['type' => 'string', 'required' => true, 'description' => 'The agent ID to launch (e.g., "1234567890123456789").'],
            'argument' => ['type' => 'object', 'description' => 'Temporary launch argument object or string accepted by Phantombuster.'],
            'arguments' => ['type' => 'object', 'description' => 'Alternative launch argument field accepted by Phantombuster.'],
            'bonus_argument' => ['type' => 'object', 'description' => 'Single-use argument merged with the saved argument.'],
            'save_argument' => ['type' => 'boolean', 'description' => 'Save argument as the default launch options.'],
            'payload' => ['type' => 'object', 'description' => 'Additional official launch fields.'],
        ];
    }

    /**
     * Launch an agent.
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

            $result = $this->service->launchAgent((string) $args['id'], $this->payload($args, [
                'argument',
                'arguments',
                'bonus_argument' => 'bonusArgument',
                'save_argument' => 'saveArgument',
            ]));

            return ToolResult::success([
                'message' => "Agent {$args['id']} has been launched.",
                'container' => $result,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
