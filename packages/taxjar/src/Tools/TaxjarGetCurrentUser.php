<?php

namespace OpenCompany\Integrations\Taxjar\Tools;

use OpenCompany\Integrations\Taxjar\TaxjarService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool to retrieve the current authenticated user from TaxJar.
 *
 * Calls GET /v2/users/me to verify credentials and return user information.
 */
class TaxjarGetCurrentUser implements Tool
{
    /**
     * Create a new TaxjarGetCurrentUser tool instance.
     *
     * @param  TaxjarService  $service  The TaxJar API service.
     */
    public function __construct(
        private TaxjarService $service,
    ) {}

    /**
     * {@inheritdoc}
     */
    public function name(): string
    {
        return 'taxjar_get_current_user';
    }

    /**
     * {@inheritdoc}
     */
    public function description(): string
    {
        return 'Retrieve the current authenticated user information from TaxJar. Use this to verify credentials are working and check user details.';
    }

    /**
     * {@inheritdoc}
     */
    public function parameters(): array
    {
        return [];
    }

    /**
     * Execute the get current user request.
     *
     * @param  array<string, mixed>  $args  Tool arguments (unused).
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('TaxJar integration is not configured.');
            }

            $result = $this->service->getCurrentUser();

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
