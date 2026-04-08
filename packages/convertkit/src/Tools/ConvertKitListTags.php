<?php

namespace OpenCompany\Integrations\ConvertKit\Tools;

use OpenCompany\Integrations\ConvertKit\ConvertKitService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List all tags in the ConvertKit account.
 *
 * Returns all tags with their IDs and names. Use these tag IDs
 * with the tag/untag subscriber tools.
 */
class ConvertKitListTags implements Tool
{
    /**
     * Create a new ConvertKitListTags tool instance.
     */
    public function __construct(
        private ConvertKitService $service,
    ) {}

    /**
     * Return the tool name used for routing.
     */
    public function name(): string
    {
        return 'convertkit_list_tags';
    }

    /**
     * Return a human-readable description of what this tool does.
     */
    public function description(): string
    {
        return 'List all tags in your ConvertKit account. Returns tag IDs and names.';
    }

    /**
     * Define the parameters this tool accepts.
     *
     * @return array<string, array<string, mixed>> Parameter definitions
     */
    public function parameters(): array
    {
        return [];
    }

    /**
     * Execute the tool: list all tags from ConvertKit.
     *
     * @param  array<string, mixed>  $args  Tool arguments (unused)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('ConvertKit integration is not configured.');
            }

            $result = $this->service->listTags();

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
