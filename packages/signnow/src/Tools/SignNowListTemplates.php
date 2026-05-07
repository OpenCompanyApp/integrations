<?php

namespace OpenCompany\Integrations\SignNow\Tools;

use OpenCompany\Integrations\SignNow\SignNowService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List SignNow templates available to the authenticated user.
 */
class SignNowListTemplates implements Tool
{
    /**
     * @param SignNowService $service The SignNow API service instance
     */
    public function __construct(
        private SignNowService $service,
    ) {}

    /**
     * Unique tool identifier.
     */
    public function name(): string
    {
        return 'signnow_list_templates';
    }

    /**
     * Human-readable description of what this tool does.
     */
    public function description(): string
    {
        return 'List document templates available in the authenticated SignNow account. Templates can be used to create new documents with pre-defined fields.';
    }

    /**
     * Define the parameters this tool accepts.
     *
     * @return array<string, array<string, mixed>>
     */
    public function parameters(): array
    {
        return [];
    }

    /**
     * Execute the list templates tool call.
     *
     * @param array<string, mixed> $args Tool arguments (unused)
     * @return ToolResult The result containing template list or error
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('SignNow integration is not configured.');
            }

            $result = $this->service->listTemplates();

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
