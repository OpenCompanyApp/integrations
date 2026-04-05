<?php

namespace OpenCompany\Integrations\DocuSign\Tools;

use OpenCompany\Integrations\DocuSign\DocuSignService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get information about the currently authenticated DocuSign user.
 *
 * Calls the OAuth userinfo endpoint to retrieve the user's name, email,
 * and associated accounts.
 */
class DocuSignGetCurrentUser implements Tool
{
    /**
     * Create a new DocuSignGetCurrentUser tool instance.
     */
    public function __construct(
        private DocuSignService $service,
    ) {}

    /**
     * The unique tool identifier.
     */
    public function name(): string
    {
        return 'docusign_get_current_user';
    }

    /**
     * A human-readable description of what the tool does.
     */
    public function description(): string
    {
        return 'Get information about the authenticated DocuSign user, including name, email, and associated accounts. Useful for verifying credentials and discovering account IDs.';
    }

    /**
     * Define the parameters this tool accepts.
     *
     * @return array<string, mixed>
     */
    public function parameters(): array
    {
        return [];
    }

    /**
     * Execute the tool call.
     *
     * @param  array<string, mixed>  $args
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('DocuSign integration is not configured.');
            }

            $result = $this->service->getCurrentUser();

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
