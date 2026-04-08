<?php

namespace OpenCompany\Integrations\Upstash\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Upstash\UpstashService;

/**
 * Tool to list Redis keys matching a pattern.
 *
 * Calls GET /keys/{pattern} on the Upstash Redis REST API.
 */
class UpstashListKeys implements Tool
{
    /**
     * Create a new UpstashListKeys tool instance.
     */
    public function __construct(
        private UpstashService $service,
    ) {}

    /**
     * The tool identifier.
     */
    public function name(): string
    {
        return 'upstash_list_keys';
    }

    /**
     * Human-readable description of what this tool does.
     */
    public function description(): string
    {
        return 'List Redis keys matching a glob-style pattern. Defaults to "*" to list all keys.';
    }

    /**
     * Parameter schema for this tool.
     */
    public function parameters(): array
    {
        return [
            'pattern' => ['type' => 'string', 'description' => 'Glob-style pattern to match keys against (default: "*").'],
        ];
    }

    /**
     * Execute the tool: list keys matching the pattern.
     *
     * @param  array  $args  Tool arguments. Optional 'pattern' (defaults to "*").
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Upstash integration is not configured.');
            }

            $pattern = $args['pattern'] ?? '*';

            $keys = $this->service->listKeys($pattern);

            return ToolResult::success([
                'pattern' => $pattern,
                'keys' => $keys,
                'count' => count($keys),
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
