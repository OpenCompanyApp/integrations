<?php

namespace OpenCompany\Integrations\HuggingFace\Tools;

use OpenCompany\Integrations\HuggingFace\HuggingFaceService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get the currently authenticated Hugging Face user's profile.
 *
 * Returns user info including name, username, email, and account type.
 */
class HuggingFaceGetCurrentUser implements Tool
{
    public function __construct(
        private HuggingFaceService $service,
    ) {}

    public function name(): string
    {
        return 'huggingface_get_current_user';
    }

    public function description(): string
    {
        return 'Get the authenticated Hugging Face user\'s profile information, including name, username, type (user/org), and avatar.';
    }

    public function parameters(): array
    {
        return [];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Hugging Face integration is not configured.');
            }

            $result = $this->service->getCurrentUser();

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
