<?php

namespace OpenCompany\Integrations\Intercom\Tools;

use OpenCompany\Integrations\Intercom\IntercomService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Retrieve the currently authenticated Intercom admin user.
 *
 * Returns the admin's ID, name, email, and avatar for the authenticated token.
 */
class IntercomGetCurrentUser implements Tool
{
    /**
     * @param  IntercomService  $service  The Intercom API client
     */
    public function __construct(
        private IntercomService $service,
    ) {}

    public function name(): string
    {
        return 'intercom_get_current_user';
    }

    public function description(): string
    {
        return <<<'MD'
        Retrieve the currently authenticated Intercom admin user.
        Returns the admin's ID, name, email, and avatar.
        Useful for identifying which workspace or token is in use.
        MD;
    }

    public function parameters(): array
    {
        return [];
    }

    /**
     * Retrieve the currently authenticated Intercom admin.
     *
     * @param  array<string, mixed>  $args  Tool arguments (none)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Intercom integration is not configured.');
            }

            $result = $this->service->getMe();

            return ToolResult::success([
                'id' => $result['id'] ?? '',
                'name' => $result['name'] ?? '',
                'email' => $result['email'] ?? '',
                'job_title' => $result['job_title'] ?? '',
                'avatar' => $result['avatar'] ?? [],
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
