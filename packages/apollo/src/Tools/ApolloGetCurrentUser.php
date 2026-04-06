<?php

namespace OpenCompany\Integrations\Apollo\Tools;

use OpenCompany\Integrations\Apollo\ApolloService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Retrieve the authenticated Apollo user's profile.
 *
 * Returns the current user's name, email, plan, and usage information.
 * Useful for verifying credentials and displaying account context.
 */
class ApolloGetCurrentUser implements Tool
{
    public function __construct(
        private ApolloService $service,
    ) {}

    public function name(): string
    {
        return 'apollo_get_current_user';
    }

    public function description(): string
    {
        return 'Retrieve the authenticated Apollo user\'s profile. Returns account information including name, email, plan type, and credit usage.';
    }

    public function parameters(): array
    {
        return [];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Apollo integration is not configured.');
            }

            $result = $this->service->getCurrentUser();

            $user = $result['user'] ?? $result;

            return ToolResult::success($this->formatUser($user));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }

    /**
     * Format a user profile for display.
     *
     * @param  array<string, mixed>  $user  Raw user data from the API.
     * @return array<string, mixed> Formatted user data.
     */
    private function formatUser(array $user): array
    {
        return [
            'id' => $user['id'] ?? null,
            'name' => trim(($user['first_name'] ?? '') . ' ' . ($user['last_name'] ?? '')),
            'email' => $user['email'] ?? null,
            'title' => $user['title'] ?? null,
            'plan' => $user['plan'] ?? $user['subscription']['plan'] ?? null,
            'credits_remaining' => $user['credits_remaining'] ?? $user['free_credits_remaining'] ?? null,
            'photo_url' => $user['photo_url'] ?? null,
            'linkedin_url' => $user['linkedin_url'] ?? null,
        ];
    }
}
