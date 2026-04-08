<?php

namespace OpenCompany\Integrations\DocuSign\Tools;

use OpenCompany\Integrations\DocuSign\DocuSignService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List envelopes in the DocuSign account.
 *
 * Retrieves a list of envelopes with optional filtering by date range, status,
 * or other criteria. Supports pagination via `start_position` and `count`.
 */
class DocuSignListEnvelopes implements Tool
{
    /**
     * Create a new DocuSignListEnvelopes tool instance.
     */
    public function __construct(
        private DocuSignService $service,
    ) {}

    /**
     * The unique tool identifier.
     */
    public function name(): string
    {
        return 'docusign_list_envelopes';
    }

    /**
     * A human-readable description of what the tool does.
     */
    public function description(): string
    {
        return 'List envelopes in the DocuSign account. Filter by status (sent, delivered, completed, signed, declined, voided), date range, or search text. Returns envelope summaries with IDs, subjects, statuses, and dates.';
    }

    /**
     * Define the parameters this tool accepts.
     *
     * @return array<string, array{type: string, required?: bool, description: string}>
     */
    public function parameters(): array
    {
        return [
            'status' => ['type' => 'string', 'description' => 'Filter by status: sent, delivered, completed, signed, declined, voided, or "all" (default: all).'],
            'from_date' => ['type' => 'string', 'description' => 'Start date for filter (YYYY-MM-DD). Defaults to 30 days ago if not specified.'],
            'to_date' => ['type' => 'string', 'description' => 'End date for filter (YYYY-MM-DD). Defaults to today.'],
            'search_text' => ['type' => 'string', 'description' => 'Search envelope subjects and recipient names.'],
            'count' => ['type' => 'integer', 'description' => 'Number of results to return (default: 25, max: 100).'],
            'start_position' => ['type' => 'integer', 'description' => 'Zero-based index for pagination (default: 0).'],
            'order' => ['type' => 'string', 'description' => 'Sort direction: "asc" or "desc" (default: "desc").'],
            'order_by' => ['type' => 'string', 'description' => 'Sort field: "last_modified", "created", or "sent" (default: "last_modified").'],
        ];
    }

    /**
     * Execute the tool call.
     *
     * @param  array<string, mixed>  $args
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('DocuSign integration is not configured. Provide access_token, account_id, and base_path.');
            }

            $params = [];
            $stringParams = ['status', 'from_date', 'to_date', 'search_text', 'order', 'order_by'];
            foreach ($stringParams as $key) {
                if (isset($args[$key])) {
                    $params[$key] = $args[$key];
                }
            }
            if (isset($args['count'])) {
                $params['count'] = (int) $args['count'];
            }
            if (isset($args['start_position'])) {
                $params['start_position'] = (int) $args['start_position'];
            }

            $result = $this->service->listEnvelopes($params);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
