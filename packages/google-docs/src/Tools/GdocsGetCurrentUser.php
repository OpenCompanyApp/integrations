<?php

namespace OpenCompany\Integrations\GoogleDocs\Tools;

use OpenCompany\Integrations\GoogleDocs\GoogleDocsService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool for retrieving the authenticated user's Google profile information.
 *
 * Uses the Google OAuth2 userinfo endpoint to get the current user's
 * ID, email, name, and profile picture.
 */
class GdocsGetCurrentUser implements Tool
{
    /**
     * Create a new GdocsGetCurrentUser tool instance.
     */
    public function __construct(
        private GoogleDocsService $service,
    ) {}

    /**
     * Get the tool name identifier.
     */
    public function name(): string
    {
        return 'gdocs_get_current_user';
    }

    /**
     * Get the tool description for AI agents.
     */
    public function description(): string
    {
        return 'Get the authenticated Google user\'s profile information. Returns user ID, email address, display name, and profile picture URL. Use this to verify which Google account is being used.';
    }

    /**
     * Get the tool parameter definitions.
     *
     * @return array<string, array<string, mixed>>
     */
    public function parameters(): array
    {
        return [];
    }

    /**
     * Execute the get current user request.
     *
     * @param  array<string, mixed>  $args  Tool arguments (none required).
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Google Docs integration is not configured.');
            }

            $result = $this->service->getCurrentUser();

            return ToolResult::success([
                'id' => $result['id'] ?? null,
                'email' => $result['email'] ?? null,
                'name' => $result['name'] ?? null,
                'givenName' => $result['given_name'] ?? null,
                'familyName' => $result['family_name'] ?? null,
                'picture' => $result['picture'] ?? null,
                'locale' => $result['locale'] ?? null,
                'verifiedEmail' => $result['verified_email'] ?? null,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
