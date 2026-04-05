<?php

namespace OpenCompany\Integrations\Chargebee\Tools;

use OpenCompany\Integrations\Chargebee\ChargebeeService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool to verify site access and retrieve Chargebee site information.
 *
 * Used primarily for connection testing and confirming credentials are valid.
 */
class ChargebeeGetCurrentUser implements Tool
{
    /**
     * Create a new ChargebeeGetCurrentUser tool instance.
     *
     * @param  ChargebeeService  $service  The Chargebee API service.
     */
    public function __construct(
        private ChargebeeService $service,
    ) {}

    /**
     * {@inheritdoc}
     */
    public function name(): string
    {
        return 'chargebee_get_current_user';
    }

    /**
     * {@inheritdoc}
     */
    public function description(): string
    {
        return 'Verify access to the Chargebee site and retrieve site configuration details. Use this to confirm credentials are working.';
    }

    /**
     * {@inheritdoc}
     */
    public function parameters(): array
    {
        return [];
    }

    /**
     * Execute the get site info request.
     *
     * @param  array<string, mixed>  $args  Tool arguments (unused).
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Chargebee integration is not configured.');
            }

            $result = $this->service->getSite();

            $site = $result['site'] ?? $result;

            return ToolResult::success(['site' => $site]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
