<?php

namespace OpenCompany\Integrations\Moosend\Tools;

use OpenCompany\Integrations\Moosend\MoosendService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class MoosendGetCurrentUser implements Tool
{
    /**
     * Create a new MoosendGetCurrentUser tool instance.
     *
     * @param MoosendService $service The Moosend service instance.
     */
    public function __construct(
        private MoosendService $service,
    ) {}

    /**
     * Get the tool name identifier.
     *
     * @return string
     */
    public function name(): string
    {
        return 'moosend_get_current_user';
    }

    /**
     * Get the tool description.
     *
     * @return string
     */
    public function description(): string
    {
        return 'Get the current authenticated Moosend user. Useful as a health check to verify API connectivity.';
    }

    /**
     * Get the tool parameter definitions.
     *
     * @return array
     */
    public function parameters(): array
    {
        return [];
    }

    /**
     * Execute the tool: get the current authenticated user from Moosend.
     *
     * @param array $args The tool arguments (none).
     * @return ToolResult The result containing user details or an error message.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Moosend integration is not configured.');
            }

            $result = $this->service->getCurrentUser();

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
