<?php

namespace OpenCompany\Integrations\Tally\Tools;

use OpenCompany\Integrations\Tally\TallyService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List all forms accessible to the authenticated Tally user.
 *
 * Returns an array of form objects including form ID, name, status,
 * number of submissions, and creation date.
 */
class TallyListForms implements Tool
{
    public function __construct(
        private TallyService $service,
    ) {}

    /**
     * Unique tool identifier.
     */
    public function name(): string
    {
        return 'tally_list_forms';
    }

    /**
     * Human-readable description of what this tool does.
     */
    public function description(): string
    {
        return 'List all forms accessible in the Tally workspace. Returns form IDs, names, status, and submission counts. Use the form IDs with other Tally tools to get details or list submissions.';
    }

    /**
     * Define the parameters this tool accepts.
     *
     * @return array<string, array{type: string, description?: string, required?: bool}>
     */
    public function parameters(): array
    {
        return [
            'limit' => ['type' => 'integer', 'description' => 'Maximum number of forms to return (default: 100).'],
            'after' => ['type' => 'string', 'description' => 'Cursor for pagination — pass the value from a previous response to get the next page.'],
        ];
    }

    /**
     * Execute the list_forms tool.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Tally integration is not configured.');
            }

            $limit = isset($args['limit']) ? (int) $args['limit'] : 100;
            $result = $this->service->listForms($limit, $args['after'] ?? null);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
