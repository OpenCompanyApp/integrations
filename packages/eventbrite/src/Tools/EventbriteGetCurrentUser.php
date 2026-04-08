<?php

namespace OpenCompany\Integrations\Eventbrite\Tools;

use OpenCompany\Integrations\Eventbrite\EventbriteService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get the currently authenticated Eventbrite user profile.
 *
 * Useful for verifying credentials and displaying account info.
 * Returns the user's name, email, and organization memberships.
 */
class EventbriteGetCurrentUser implements Tool
{
    /**
     * Create a new tool instance.
     */
    public function __construct(
        private EventbriteService $service,
    ) {}

    /**
     * The tool name used for dispatch.
     */
    public function name(): string
    {
        return 'eventbrite_get_current_user';
    }

    /**
     * A human-readable description of what the tool does.
     */
    public function description(): string
    {
        return 'Get the currently authenticated Eventbrite user profile. Returns name, email, and organization memberships. Useful for verifying credentials.';
    }

    /**
     * Define the parameters the tool accepts.
     *
     * @return array<string, array<string, mixed>>
     */
    public function parameters(): array
    {
        return [];
    }

    /**
     * Execute the tool and return a result.
     *
     * @param  array<string, mixed>  $args
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Eventbrite integration is not configured. Provide a token and organization ID.');
            }

            $result = $this->service->getCurrentUser();

            return ToolResult::success([
                'id' => $result['id'] ?? null,
                'name' => $result['name'] ?? null,
                'first_name' => $result['first_name'] ?? null,
                'last_name' => $result['last_name'] ?? null,
                'emails' => $result['emails'] ?? [],
                'image_id' => $result['image_id'] ?? null,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
