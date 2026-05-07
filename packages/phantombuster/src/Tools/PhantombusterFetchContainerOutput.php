<?php

namespace OpenCompany\Integrations\Phantombuster\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Fetch output for a specific container.
 */
class PhantombusterFetchContainerOutput extends AbstractPhantombusterTool implements Tool
{
    public function name(): string
    {
        return 'phantombuster_fetch_container_output';
    }

    public function description(): string
    {
        return 'Fetch JSON or raw output for a Phantombuster container.';
    }

    public function parameters(): array
    {
        return [
            'id' => ['type' => 'string', 'required' => true, 'description' => 'Container ID.'],
            'mode' => ['type' => 'string', 'enum' => ['json', 'raw'], 'description' => 'Output mode. Defaults to json.'],
        ];
    }

    /**
     * Fetch container output.
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

            $mode = isset($args['mode']) && is_scalar($args['mode']) ? (string) $args['mode'] : null;

            return ToolResult::success($this->service->fetchContainerOutput((string) $args['id'], $mode));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
