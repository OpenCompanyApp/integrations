<?php

namespace OpenCompany\Integrations\Magento\Tools;

use OpenCompany\Integrations\Magento\MagentoService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool to verify Magento API connectivity and retrieve current user info.
 *
 * Acts as a health check by calling the /me endpoint to confirm
 * the access token is valid.
 */
class MagentoGetCurrentUser implements Tool
{
    /**
     * Create a new MagentoGetCurrentUser tool instance.
     *
     * @param  \OpenCompany\Integrations\Magento\MagentoService  $service
     */
    public function __construct(
        private MagentoService $service,
    ) {}

    /**
     * {@inheritDoc}
     */
    public function name(): string
    {
        return 'magento_get_current_user';
    }

    /**
     * {@inheritDoc}
     */
    public function description(): string
    {
        return 'Verify Magento API connectivity and retrieve current user information. Useful as a health check to confirm the integration is properly configured.';
    }

    /**
     * {@inheritDoc}
     */
    public function parameters(): array
    {
        return [];
    }

    /**
     * {@inheritDoc}
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Magento integration is not configured.');
            }

            $result = $this->service->getCurrentUser();

            return ToolResult::success([
                'connected' => true,
                'base_url' => $this->service->getBaseUrl(),
                'user' => $result,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
