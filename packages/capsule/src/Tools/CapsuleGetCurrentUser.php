<?php

namespace OpenCompany\Integrations\Capsule\Tools;

use OpenCompany\Integrations\Capsule\CapsuleService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Retrieve the currently authenticated Capsule CRM user.
 *
 * Useful for verifying credentials and identifying which account
 * the integration is connected to.
 */
class CapsuleGetCurrentUser implements Tool
{
    /**
     * @param  CapsuleService  $service  The Capsule CRM API client.
     */
    public function __construct(
        private CapsuleService $service,
    ) {}

    public function name(): string
    {
        return 'capsule_get_current_user';
    }

    public function description(): string
    {
        return 'Get the currently authenticated Capsule CRM user. Use this to verify credentials or identify the connected account.';
    }

    public function parameters(): array
    {
        return [];
    }

    /**
     * Get the authenticated Capsule CRM user.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Capsule CRM integration is not configured.');
            }

            $result = $this->service->getCurrentUser();

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
