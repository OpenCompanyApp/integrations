<?php

namespace OpenCompany\Integrations\Openrouter\Tools;

use OpenCompany\Integrations\Openrouter\OpenrouterService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List API keys for the OpenRouter account.
 *
 * Sends a GET request to /keys and returns the list
 * of API key resources.
 *
 * @see https://openrouter.ai/docs/api-reference/list-api-keys
 */
class OpenrouterListApiKeys implements Tool
{
    /**
     * @param  OpenrouterService  $service  The OpenRouter service instance.
     */
    public function __construct(
        private OpenrouterService $service,
    ) {}

    /**
     * The tool identifier.
     */
    public function name(): string
    {
        return 'openrouter_list_api_keys';
    }

    /**
     * Human-readable description of what this tool does.
     */
    public function description(): string
    {
        return 'List API keys for the OpenRouter account. Returns key names, creation dates, and usage limits.';
    }

    /**
     * Parameter schema — no parameters required.
     *
     * @return array<string, array{type: string, required?: bool, description: string}>
     */
    public function parameters(): array
    {
        return [];
    }

    /**
     * Execute the list API keys request.
     *
     * @param  array  $args  No parameters required.
     * @return ToolResult The list of API keys or an error.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('OpenRouter integration is not configured.');
            }

            $result = $this->service->listApiKeys();

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
