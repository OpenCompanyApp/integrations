<?php

namespace OpenCompany\Integrations\Coda\Tools;

use OpenCompany\Integrations\Coda\CodaService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool to verify Coda authentication and get the current user's profile.
 */
class CodaGetCurrentUser implements Tool
{
    /**
     * Create a new CodaGetCurrentUser tool instance.
     *
     * @param  CodaService  $service  The Coda API service.
     */
    public function __construct(
        private CodaService $service,
    ) {}

    /**
     * {@inheritdoc}
     */
    public function name(): string
    {
        return 'coda_get_current_user';
    }

    /**
     * {@inheritdoc}
     */
    public function description(): string
    {
        return 'Verify Coda authentication and get the current user\'s profile information.';
    }

    /**
     * {@inheritdoc}
     */
    public function parameters(): array
    {
        return [];
    }

    /**
     * Execute the tool: get the current user from the Coda API.
     *
     * @param  array<string, mixed>  $args  The tool arguments (unused).
     * @return ToolResult The result containing the user profile.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Coda integration is not configured.');
            }

            $result = $this->service->whoami();

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
