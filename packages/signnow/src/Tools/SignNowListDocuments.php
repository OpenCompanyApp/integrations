<?php

namespace OpenCompany\Integrations\SignNow\Tools;

use OpenCompany\Integrations\SignNow\SignNowService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List SignNow documents accessible to the authenticated user.
 */
class SignNowListDocuments implements Tool
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
        return 'signnow_list_documents';
    }

    /**
     * Human-readable description of what this tool does.
     */
    public function description(): string
    {
        return 'List documents accessible to the authenticated SignNow user. Returns document IDs, names, and status. Supports pagination with page and per_page parameters.';
    }

    /**
     * Define the parameters this tool accepts.
     *
     * @return array<string, array<string, mixed>>
     */
    public function parameters(): array
    {
        return [
            'page' => ['type' => 'integer', 'description' => 'Page number for pagination (1-based). Default: 1.'],
            'per_page' => ['type' => 'integer', 'description' => 'Number of documents per page. Default: 20.'],
        ];
    }

    /**
     * Execute the list documents tool call.
     *
     * @param array<string, mixed> $args Tool arguments
     * @return ToolResult The result containing document list or error
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('SignNow integration is not configured.');
            }

            $page = isset($args['page']) ? (int) $args['page'] : 1;
            $perPage = isset($args['per_page']) ? (int) $args['per_page'] : 20;

            $result = $this->service->listDocuments($page, $perPage);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
