<?php

namespace OpenCompany\Integrations\PostHog\Tools;

use OpenCompany\Integrations\PostHog\PostHogService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool for retrieving a single PostHog person (user) by their ID.
 */
class PostHogGetPerson implements Tool
{
    /**
     * Create a new PostHogGetPerson tool instance.
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
        return 'posthog_get_person';
    }

    /**
     * Get the tool description.
     *
     * @return string A human-readable description of what the tool does.
     */
    public function description(): string
    {
        return 'Get details of a specific PostHog person (user) by their unique ID, including properties and event history metadata.';
    }

    /**
     * Get the tool parameter definitions.
     *
     * @return array<string, array<string, mixed>> Parameter definitions keyed by name.
     */
    public function parameters(): array
    {
        return [
            'person_id' => ['type' => 'string', 'required' => true, 'description' => 'The unique identifier (UUID) of the person to retrieve.'],
        ];
    }

    /**
     * Execute the get person tool.
     *
     * @param  array<string, mixed>  $args  The tool arguments containing person_id.
     * @return ToolResult The result containing the person details.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('PostHog integration is not configured.');
            }

            $personId = $args['person_id'] ?? '';
            if (empty($personId)) {
                return ToolResult::error('The "person_id" parameter is required.');
            }

            $result = $this->service->getPerson($personId);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
