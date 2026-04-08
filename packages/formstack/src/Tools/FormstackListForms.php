<?php

namespace OpenCompany\Integrations\Formstack\Tools;

use OpenCompany\Integrations\Formstack\FormstackService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * FormstackListForms — List all forms in the authenticated user's Formstack account.
 *
 * Returns a paginated list of forms with their IDs, names, and metadata.
 * Supports optional search filtering by form name.
 *
 * @see https://www.formstack.com/docs/api/v2/form#get-all-forms
 */
class FormstackListForms implements Tool
{
    /**
     * @param  FormstackService  $service  The Formstack API service instance.
     */
    public function __construct(
        private FormstackService $service,
    ) {}

    /**
     * Machine name of the tool.
     */
    public function name(): string
    {
        return 'formstack_list_forms';
    }

    /**
     * Human-readable description of what the tool does.
     */
    public function description(): string
    {
        return 'List all forms in your Formstack account. Returns form names, IDs, and pagination info. Use search to filter by name.';
    }

    /**
     * Parameter schema for the tool.
     *
     * @return array<string, array<string, mixed>>
     */
    public function parameters(): array
    {
        return [
            'page' => ['type' => 'integer', 'description' => 'Page number for pagination (default: 1).'],
            'per_page' => ['type' => 'integer', 'description' => 'Number of forms per page (default: 25, max: 200).'],
            'search' => ['type' => 'string', 'description' => 'Optional search string to filter forms by name.'],
        ];
    }

    /**
     * Execute the tool — list forms from Formstack.
     *
     * @param  array{page?: int, per_page?: int, search?: string}  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Formstack integration is not configured.');
            }

            $page = isset($args['page']) ? (int) $args['page'] : 1;
            $perPage = isset($args['per_page']) ? (int) $args['per_page'] : 25;
            $search = $args['search'] ?? null;

            $result = $this->service->listForms($page, $perPage, $search);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
