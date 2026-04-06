<?php

namespace OpenCompany\Integrations\Upstash\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Upstash\UpstashService;

/**
 * Tool to delete a key from Redis.
 *
 * Calls GET /del/{key} on the Upstash Redis REST API.
 */
class UpstashDeleteKey implements Tool
{
    /**
     * Create a new UpstashDeleteKey tool instance.
     */
    public function __construct(
        private UpstashService $service,
    ) {}

    /**
     * The tool identifier.
     */
    public function name(): string
    {
        return 'upstash_delete_key';
    }

    /**
     * Human-readable description of what this tool does.
     */
    public function description(): string
    {
        return 'Delete a key from Redis. Returns the number of keys that were removed.';
    }

    /**
     * Parameter schema for this tool.
     */
    public function parameters(): array
    {
        return [
            'key' => ['type' => 'string', 'description' => 'The Redis key to delete.', 'required' => true],
        ];
    }

    /**
     * Execute the tool: delete the given key.
     *
     * @param  array  $args  Tool arguments. Must contain 'key'.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Upstash integration is not configured.');
            }

            $key = $args['key'] ?? '';

            if (empty($key)) {
                return ToolResult::error('The "key" parameter is required.');
            }

            $result = $this->service->delete($key);

            return ToolResult::success([
                'key' => $key,
                'deleted' => $result,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
