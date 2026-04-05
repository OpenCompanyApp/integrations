<?php

namespace OpenCompany\Integrations\Intercom\Tools;

use OpenCompany\Integrations\Intercom\IntercomService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List Intercom conversations with pagination and sorting.
 *
 * Returns a paginated list of conversations with their IDs and metadata.
 */
class IntercomListConversations implements Tool
{
    /**
     * @param  IntercomService  $service  The Intercom API client
     */
    public function __construct(
        private IntercomService $service,
    ) {}

    public function name(): string
    {
        return 'intercom_list_conversations';
    }

    public function description(): string
    {
        return <<<'MD'
        List Intercom conversations with pagination and sorting.
        Returns conversation IDs, created dates, and state.
        Use limit, starting_after, and sort_order for pagination and ordering.
        MD;
    }

    public function parameters(): array
    {
        return [
            'limit' => ['type' => 'integer', 'description' => 'Maximum number of conversations to return (default 20).'],
            'starting_after' => ['type' => 'string', 'description' => 'Pagination cursor from a previous response.'],
            'sort_order' => ['type' => 'string', 'description' => 'Sort order: "asc" or "desc".'],
        ];
    }

    /**
     * List Intercom conversations with optional pagination and sorting.
     *
     * @param  array<string, mixed>  $args  Tool arguments (limit, starting_after, sort_order)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Intercom integration is not configured.');
            }

            $params = [];

            if (isset($args['limit'])) {
                $params['limit'] = (int) $args['limit'];
            }
            if (! empty($args['starting_after'])) {
                $params['starting_after'] = $args['starting_after'];
            }
            if (! empty($args['sort_order'])) {
                $params['sort_order'] = $args['sort_order'];
            }

            $result = $this->service->listConversations($params);

            $conversations = array_map(function (array $conv): array {
                return [
                    'id' => $conv['id'] ?? '',
                    'created_at' => $conv['created_at'] ?? '',
                    'updated_at' => $conv['updated_at'] ?? '',
                    'state' => $conv['state'] ?? '',
                    'source' => $conv['source'] ?? [],
                ];
            }, $result['conversations'] ?? []);

            $output = ['results' => $conversations];

            if (isset($result['pages']['next']['starting_after'])) {
                $output['starting_after'] = $result['pages']['next']['starting_after'];
            }

            return ToolResult::success($output);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
