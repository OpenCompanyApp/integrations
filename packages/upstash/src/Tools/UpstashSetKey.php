<?php

namespace OpenCompany\Integrations\Upstash\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Upstash\UpstashService;

/**
 * Tool to store a key-value pair in Redis with an optional TTL.
 *
 * Calls POST /pipeline with ["SET", key, value] (and optionally ["EXPIRE", key, ttl])
 * on the Upstash Redis REST API.
 */
class UpstashSetKey implements Tool
{
    /**
     * Create a new UpstashSetKey tool instance.
     */
    public function __construct(
        private UpstashService $service,
    ) {}

    /**
     * The tool identifier.
     */
    public function name(): string
    {
        return 'upstash_set_key';
    }

    /**
     * Human-readable description of what this tool does.
     */
    public function description(): string
    {
        return 'Store a key-value pair in Redis. Optionally set a TTL (time-to-live) in seconds so the key expires automatically.';
    }

    /**
     * Parameter schema for this tool.
     */
    public function parameters(): array
    {
        return [
            'key' => ['type' => 'string', 'description' => 'The Redis key to set.', 'required' => true],
            'value' => ['type' => 'string', 'description' => 'The value to store.', 'required' => true],
            'ex' => ['type' => 'integer', 'description' => 'Time-to-live in seconds (optional).'],
        ];
    }

    /**
     * Execute the tool: set the key-value pair.
     *
     * @param  array  $args  Tool arguments. Must contain 'key' and 'value'. Optional 'ex' for TTL.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Upstash integration is not configured.');
            }

            $key = $args['key'] ?? '';
            $value = $args['value'] ?? '';
            $ttl = isset($args['ex']) ? (int) $args['ex'] : null;

            if (empty($key)) {
                return ToolResult::error('The "key" parameter is required.');
            }

            if ($value === '') {
                return ToolResult::error('The "value" parameter is required.');
            }

            $result = $this->service->set($key, (string) $value, $ttl);

            return ToolResult::success([
                'key' => $key,
                'value' => $value,
                'ttl' => $ttl,
                'result' => $result,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
