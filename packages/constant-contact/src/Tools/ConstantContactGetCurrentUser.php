<?php

namespace OpenCompany\Integrations\ConstantContact\Tools;

use OpenCompany\Integrations\ConstantContact\ConstantContactService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool: Get Current User
 *
 * Retrieves Constant Contact account summary information.
 *
 * The slug is kept for backward compatibility with older hosts.
 */
class ConstantContactGetCurrentUser implements Tool
{
    /**
     * @param  ConstantContactService  $service  The Constant Contact API service.
     */
    public function __construct(
        private ConstantContactService $service,
    ) {}

    /**
     * The unique tool slug.
     */
    public function name(): string
    {
        return 'constantcontact_get_current_user';
    }

    /**
     * Human-readable description shown in tool catalogs and generated docs.
     */
    public function description(): string
    {
        return 'Get Constant Contact account summary information. The slug is retained for backward compatibility.';
    }

    /**
     * Parameter definitions for the tool.
     *
     * @return array<string, mixed>
     */
    public function parameters(): array
    {
        return [];
    }

    /**
     * Execute the get current user tool.
     *
     * @param  array<string, mixed>  $args  Tool arguments (none).
     * @return ToolResult
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Constant Contact integration is not configured.');
            }

            $result = $this->service->getCurrentUser();

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
