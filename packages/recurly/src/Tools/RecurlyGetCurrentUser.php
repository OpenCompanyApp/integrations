<?php

namespace OpenCompany\Integrations\Recurly\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Recurly\RecurlyService;

/**
 * Verify Recurly credentials with a lightweight API request.
 *
 * Recurly does not expose a current-user endpoint, so this fetches
 * the first billing account as a health check.
 */
class RecurlyGetCurrentUser implements Tool
{
    /**
     * Create a new RecurlyGetCurrentUser tool instance.
     *
     * @param RecurlyService $service The Recurly API service.
     */
    public function __construct(
        private RecurlyService $service,
    ) {}

    /**
     * Get the tool name.
     *
     * @return string The tool identifier.
     */
    public function name(): string
    {
        return 'recurly_get_current_user';
    }

    /**
     * Get the tool description.
     *
     * @return string A human-readable description of what the tool does.
     */
    public function description(): string
    {
        return 'Verify the Recurly API connection by fetching the first account. Useful as a health check.';
    }

    /**
     * Get the tool parameters.
     *
     * @return array An empty array — this tool takes no parameters.
     */
    public function parameters(): array
    {
        return [];
    }

    /**
     * Execute the tool and return the result.
     *
     * Fetches the first account from Recurly as a health check.
     *
     * @param array $args No arguments required.
     * @return ToolResult The result containing the first account or an error.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Recurly integration is not configured.');
            }

            $result = $this->service->listAccounts(1);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
