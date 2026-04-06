<?php

namespace OpenCompany\Integrations\GoogleChat\Tools;

use OpenCompany\Integrations\GoogleChat\GoogleChatService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class GoogleChatGetCurrentUser implements Tool
{
    public function __construct(
        private GoogleChatService $service,
    ) {}

    public function name(): string
    {
        return 'google_chat_get_current_user';
    }

    public function description(): string
    {
        return 'Get the authenticated user\'s membership details in a Google Chat space. Returns the user\'s display name, role, and membership state.';
    }

    public function parameters(): array
    {
        return [
            'parent' => ['type' => 'string', 'required' => true, 'description' => 'Resource name of the space (e.g., "spaces/AAAAAAAAAAA").'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Google Chat integration is not configured.');
            }

            $result = $this->service->getCurrentUser($args['parent']);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
