<?php

namespace OpenCompany\Integrations\Phantombuster\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Fetch a container result object.
 */
class PhantombusterFetchContainerResultObject extends AbstractPhantombusterTool implements Tool
{
    public function name(): string
    {
        return 'phantombuster_fetch_container_result_object';
    }

    public function description(): string
    {
        return 'Fetch the result object associated with a Phantombuster container.';
    }

    public function parameters(): array
    {
        return [
            'id' => ['type' => 'string', 'required' => true, 'description' => 'Container ID.'],
        ];
    }

    /**
     * Fetch a container result object.
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

            return ToolResult::success($this->service->fetchContainerResultObject((string) $args['id']));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
