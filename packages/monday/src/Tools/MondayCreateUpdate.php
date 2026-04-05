<?php

namespace OpenCompany\Integrations\Monday\Tools;

use OpenCompany\Integrations\Monday\MondayService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Add an update (comment) to a Monday.com item.
 *
 * Uses the `create_update` mutation to post a text update on an item,
 * which appears in the item's updates section.
 */
class MondayCreateUpdate implements Tool
{
    /**
     * @param  MondayService  $service  The Monday.com API client
     */
    public function __construct(
        private MondayService $service,
    ) {}

    public function name(): string
    {
        return 'monday_create_update';
    }

    public function description(): string
    {
        return 'Add an update (comment) to a Monday.com item.';
    }

    public function parameters(): array
    {
        return [
            'item_id' => ['type' => 'integer', 'required' => true, 'description' => 'The ID of the item to add the update to.'],
            'body'    => ['type' => 'string',  'required' => true, 'description' => 'The text content of the update.'],
        ];
    }

    /**
     * Create an update on the specified item.
     *
     * @param  array<string, mixed>  $args  Tool arguments (item_id, body)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Monday.com integration is not configured.');
            }

            $itemId = $args['item_id'] ?? null;
            $body = $args['body'] ?? '';

            if (empty($itemId)) {
                return ToolResult::error('item_id is required.');
            }

            if (empty($body)) {
                return ToolResult::error('body is required.');
            }

            $escapedBody = $this->escapeGraphQL($body);

            $query = "mutation { create_update (item_id: {$itemId}, body: \"{$escapedBody}\") { id body } }";

            $result = $this->service->graphql($query);

            return ToolResult::success($result['create_update'] ?? []);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }

    /**
     * Escape a string for safe embedding in a GraphQL query.
     *
     * @param  string  $value  The raw string value
     * @return string  The escaped string
     */
    private function escapeGraphQL(string $value): string
    {
        return str_replace(
            ['\\', '"', "\n", "\r", "\t"],
            ['\\\\', '\\"', '\\n', '\\r', '\\t'],
            $value,
        );
    }
}
