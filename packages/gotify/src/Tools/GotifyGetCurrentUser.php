<?php

namespace OpenCompany\Integrations\Gotify\Tools;

use OpenCompany\Integrations\Gotify\GotifyService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class GotifyGetCurrentUser implements Tool
{
    public function __construct(
        private GotifyService $service,
    ) {}

    public function name(): string
    {
        return 'gotify_get_current_user';
    }

    public function description(): string
    {
        return 'Get information about the currently authenticated Gotify user, including username and admin status.';
    }

    public function parameters(): array
    {
        return [];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Gotify integration is not configured.');
            }

            $result = $this->service->getCurrentUser();

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
