<?php

namespace OpenCompany\Integrations\Phantombuster\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Stop a running Phantombuster agent.
 */
class PhantombusterStopAgent extends AbstractPhantombusterTool implements Tool
{
    public function name(): string
    {
        return 'phantombuster_stop_agent';
    }

    public function description(): string
    {
        return 'Stop a running Phantombuster agent.';
    }

    public function parameters(): array
    {
        return [
            'id' => ['type' => 'string', 'required' => true, 'description' => 'Agent ID.'],
        ];
    }

    /**
     * Stop an agent.
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

            return ToolResult::success($this->service->stopAgent((string) $args['id']));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
