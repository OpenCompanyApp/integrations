<?php

namespace OpenCompany\Integrations\RingCentral\Tools;

use OpenCompany\Integrations\RingCentral\RingCentralService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool to get the current authenticated user's extension information from RingCentral.
 */
class RingCentralGetCurrentUser implements Tool
{
    /**
     * Create a new RingCentralGetCurrentUser tool instance.
     *
     * @param  RingCentralService  $service  The RingCentral API service.
     */
    public function __construct(
        private RingCentralService $service,
    ) {}

    /**
     * Get the tool name identifier.
     */
    public function name(): string
    {
        return 'ringcentral_get_current_user';
    }

    /**
     * Get the human-readable tool description.
     */
    public function description(): string
    {
        return 'Get information about the currently authenticated RingCentral extension. Returns extension ID, name, status, phone numbers, and account details.';
    }

    /**
     * Get the tool parameter definitions.
     *
     * @return array<string, array{type: string, required?: bool, description: string}>
     */
    public function parameters(): array
    {
        return [];
    }

    /**
     * Execute the tool with the given arguments.
     *
     * @param  array  $args  The tool arguments (none required for this tool).
     * @return ToolResult The result containing the user's extension information or an error.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('RingCentral integration is not configured.');
            }

            $result = $this->service->getCurrentUser();

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
