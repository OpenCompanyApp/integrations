<?php

namespace OpenCompany\Integrations\Upstash\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Upstash\UpstashService;

/**
 * Tool to retrieve a value from Redis by key.
 *
 * Calls GET /get/{key} on the Upstash Redis REST API.
 */
class UpstashGetKey implements Tool
{
    /**
     * Create a new UpstashGetKey tool instance.
     */
    public function __construct(
        private UpstashService $service,
    ) {}

    /**
     * The tool identifier.
     */
    public function name(): string
    {
        return 'upstash_get_key';
    }

    /**
     * Human-readable description of what this tool does.
     */
    public function description(): string
    {
        return 'Retrieve the value stored at a Redis key. Returns null if the key does not exist.';
    }

    /**
     * Parameter schema for this tool.
     */
    public function parameters(): array
    {
        return [
            'key' => ['type' => 'string', 'description' => 'The Redis key to retrieve.', 'required' => true],
        ];
    }

    /**
     * Execute the tool: fetch the value at the given key.
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

            $result = $this->service->get($key);

            return ToolResult::success([
                'key' => $key,
                'value' => $result,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
