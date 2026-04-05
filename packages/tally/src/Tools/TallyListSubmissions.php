<?php

namespace OpenCompany\Integrations\Tally\Tools;

use OpenCompany\Integrations\Tally\TallyService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List submissions for a specific Tally form.
 *
 * Returns paginated submission data including field responses,
 * submission timestamps, and respondent metadata.
 */
class TallyListSubmissions implements Tool
{
    public function __construct(
        private TallyService $service,
    ) {}

    /**
     * Unique tool identifier.
     */
    public function name(): string
    {
        return 'tally_list_submissions';
    }

    /**
     * Human-readable description of what this tool does.
     */
    public function description(): string
    {
        return 'List submissions for a specific Tally form. Returns respondent answers, submission dates, and metadata. Supports filtering by date range and pagination.';
    }

    /**
     * Define the parameters this tool accepts.
     *
     * @return array<string, array{type: string, description?: string, required?: bool}>
     */
    public function parameters(): array
    {
        return [
            'form_id' => ['type' => 'string', 'required' => true, 'description' => 'The Tally form ID (e.g., "mVlDK4").'],
            'limit' => ['type' => 'integer', 'description' => 'Maximum number of submissions to return (default: 100).'],
            'after' => ['type' => 'string', 'description' => 'Cursor for pagination — pass the value from a previous response to get the next page.'],
            'submitted_after' => ['type' => 'string', 'description' => 'ISO 8601 date string to filter submissions after this date (e.g., "2025-01-01T00:00:00Z").'],
            'submitted_before' => ['type' => 'string', 'description' => 'ISO 8601 date string to filter submissions before this date (e.g., "2025-12-31T23:59:59Z").'],
        ];
    }

    /**
     * Execute the list_submissions tool.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Tally integration is not configured.');
            }

            $formId = $args['form_id'];
            $limit = isset($args['limit']) ? (int) $args['limit'] : 100;

            $result = $this->service->listSubmissions(
                $formId,
                $limit,
                $args['after'] ?? null,
                $args['submitted_after'] ?? null,
                $args['submitted_before'] ?? null,
            );

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
