<?php

namespace OpenCompany\Integrations\PostHog\Tools;

use OpenCompany\Integrations\PostHog\PostHogService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool for listing persons (users) from PostHog with optional search.
 */
class PostHogListPersons implements Tool
{
    /**
     * Create a new PostHogListPersons tool instance.
     *
     * @param  PostHogService  $service  The PostHog service for making API calls.
     */
    public function __construct(
        private PostHogService $service,
    ) {}

    /**
     * Get the tool name identifier.
     *
     * @return string The unique tool name.
     */
    public function name(): string
    {
        return 'posthog_list_persons';
    }

    /**
     * Get the tool description.
     *
     * @return string A human-readable description of what the tool does.
     */
    public function description(): string
    {
        return 'List persons (users) from PostHog. Optionally search by name, email, or distinct ID to find specific users.';
    }

    /**
     * Get the tool parameter definitions.
     *
     * @return array<string, array<string, mixed>> Parameter definitions keyed by name.
     */
    public function parameters(): array
    {
        return [
            'limit' => ['type' => 'integer', 'description' => 'Maximum number of persons to return (default: 100).'],
            'offset' => ['type' => 'integer', 'description' => 'Number of persons to skip for pagination (default: 0).'],
            'search' => ['type' => 'string', 'description' => 'Search query to filter persons by name, email, or distinct ID.'],
        ];
    }

    /**
     * Execute the list persons tool.
     *
     * @param  array<string, mixed>  $args  The tool arguments for filtering and pagination.
     * @return ToolResult The result containing the list of persons.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('PostHog integration is not configured.');
            }

            $result = $this->service->listPersons(
                limit: isset($args['limit']) ? (int) $args['limit'] : 100,
                offset: isset($args['offset']) ? (int) $args['offset'] : 0,
                search: $args['search'] ?? null,
            );

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
