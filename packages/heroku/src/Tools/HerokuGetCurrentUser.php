<?php

namespace OpenCompany\Integrations\Heroku\Tools;

use OpenCompany\Integrations\Heroku\HerokuService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Retrieve the authenticated Heroku account.
 */
class HerokuGetCurrentUser implements Tool
{
    /**
     * @param  HerokuService  $service  The Heroku Platform API client.
     */
    public function __construct(
        private HerokuService $service,
    ) {}

    public function name(): string
    {
        return 'heroku_get_current_user';
    }

    public function description(): string
    {
        return 'Get information about the current authenticated Heroku account, including email, name, and verified status.';
    }

    public function parameters(): array
    {
        return [];
    }

    /**
     * Fetch the current Heroku account details.
     *
     * @param  array<string, mixed>  $args  Tool arguments; none are required.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Heroku integration is not configured.');
            }

            $result = $this->service->getCurrentUser();

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
