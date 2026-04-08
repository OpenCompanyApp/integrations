<?php

namespace OpenCompany\Integrations\Revolut\Tools;

use OpenCompany\Integrations\Revolut\RevolutService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get the currently authenticated Revolut user.
 *
 * Returns user profile information including name, email, and phone.
 */
class RevolutGetCurrentUser implements Tool
{
    /**
     * @param  RevolutService  $service  The Revolut API client
     */
    public function __construct(
        private RevolutService $service,
    ) {}

    public function name(): string
    {
        return 'revolut_get_current_user';
    }

    public function description(): string
    {
        return <<<'MD'
        Get the currently authenticated Revolut user.
        Returns user profile information including name, email, and phone.
        MD;
    }

    public function parameters(): array
    {
        return [];
    }

    /**
     * Get the currently authenticated Revolut user.
     *
     * @param  array<string, mixed>  $args  Tool arguments (none)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Revolut integration is not configured.');
            }

            $user = $this->service->getCurrentUser();

            return ToolResult::success([
                'id' => $user['id'] ?? '',
                'first_name' => $user['first_name'] ?? '',
                'last_name' => $user['last_name'] ?? '',
                'email' => $user['email'] ?? '',
                'phone' => $user['phone'] ?? null,
                'state' => $user['state'] ?? '',
                'created_at' => $user['created_at'] ?? null,
                'updated_at' => $user['updated_at'] ?? null,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
