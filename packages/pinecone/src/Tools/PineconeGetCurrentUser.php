<?php

namespace OpenCompany\Integrations\Pinecone\Tools;

use OpenCompany\Integrations\Pinecone\PineconeService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get information about the currently authenticated Pinecone user.
 *
 * Returns the user's email, name, and project-level details.
 * Useful for verifying that the access token is valid.
 */
class PineconeGetCurrentUser implements Tool
{
    public function __construct(
        private PineconeService $service,
    ) {}

    public function name(): string
    {
        return 'pinecone_get_current_user';
    }

    public function description(): string
    {
        return 'Get information about the currently authenticated Pinecone user, including email, name, and project details.';
    }

    public function parameters(): array
    {
        return [];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Pinecone integration is not configured.');
            }

            $result = $this->service->getCurrentUser();

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
