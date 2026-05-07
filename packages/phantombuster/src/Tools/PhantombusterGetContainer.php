<?php

namespace OpenCompany\Integrations\Phantombuster\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get one Phantombuster container.
 */
class PhantombusterGetContainer extends AbstractPhantombusterTool implements Tool
{
    public function name(): string
    {
        return 'phantombuster_get_container';
    }

    public function description(): string
    {
        return 'Get details for a specific Phantombuster container (execution run), including its status, output, and logs.';
    }

    public function parameters(): array
    {
        return [
            'id' => ['type' => 'string', 'required' => true, 'description' => 'The container ID (e.g., "9876543210987654321").'],
            'with_result_object' => ['type' => 'boolean', 'description' => 'Include the result object.'],
            'with_output' => ['type' => 'boolean', 'description' => 'Include output.'],
            'with_runtime_events' => ['type' => 'boolean', 'description' => 'Include runtime events.'],
            'with_newer_and_older_container_id' => ['type' => 'boolean', 'description' => 'Include adjacent container IDs.'],
        ];
    }

    /**
     * Fetch a container by ID.
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
                return ToolResult::error('Container ID is required.');
            }

            $result = $this->service->getContainer((string) $args['id'], $this->only($args, [
                'with_result_object' => 'withResultObject',
                'with_output' => 'withOutput',
                'with_runtime_events' => 'withRuntimeEvents',
                'with_newer_and_older_container_id' => 'withNewerAndOlderContainerId',
            ]));

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
