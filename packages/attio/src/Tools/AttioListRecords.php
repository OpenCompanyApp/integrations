<?php

namespace OpenCompany\Integrations\Attio\Tools;

use OpenCompany\Integrations\Attio\AttioService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List Attio records for an object.
 */
class AttioListRecords implements Tool
{
    /**
     * Create a new AttioListRecords tool instance.
     */
    public function __construct(
        private AttioService $service,
    ) {}

    /**
     * The tool name used for registration and invocation.
     */
    public function name(): string
    {
        return 'attio_list_records';
    }

    /**
     * A description of what this tool does, used by AI agents to decide when to call it.
     */
    public function description(): string
    {
        return 'List records for an object type in Attio (e.g. people, companies, deals). Supports filtering, sorting, and pagination via a POST query endpoint. Use filters to narrow results by attribute values and sorts to control ordering.';
    }

    /**
     * The parameters this tool accepts.
     *
     * @return array<string, array<string, mixed>>
     */
    public function parameters(): array
    {
        return [
            'object_id' => ['type' => 'string', 'required' => true, 'description' => 'The object slug or ID (e.g. "people", "companies", "deals").'],
            'limit' => ['type' => 'integer', 'description' => 'Maximum number of records to return (default: 20, max: 500).'],
            'offset' => ['type' => 'integer', 'description' => 'Number of records to skip for pagination (default: 0).'],
            'sorts' => ['type' => 'array', 'description' => 'Sort definitions. Each entry is an object with "attribute" (object with "slug") and "direction" ("asc" or "desc"). Example: [{"attribute": {"slug": "name"}, "direction": "asc"}].'],
            'filters' => ['type' => 'object', 'description' => 'Filter definitions following Attio\'s filter grammar. Can be a single filter or a compound filter with "$and"/"$or". Example: {"$and": [{"attribute": {"slug": "name"}, "condition": "contains", "value": "Acme"}]}.'],
        ];
    }

    /**
     * Execute the tool with the given arguments.
     *
     * @param  array<string, mixed>  $args  The tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Attio integration is not configured.');
            }

            $objectId = $args['object_id'];
            $limit = isset($args['limit']) ? (int) $args['limit'] : 20;
            $offset = isset($args['offset']) ? (int) $args['offset'] : 0;
            $sorts = $args['sorts'] ?? [];
            $filters = $args['filters'] ?? [];

            // Handle JSON-string sorts/filters from AI agents
            if (is_string($sorts)) {
                $sorts = json_decode($sorts, true) ?? [];
            }
            if (is_string($filters)) {
                $filters = json_decode($filters, true) ?? [];
            }

            $result = $this->service->listRecords($objectId, $limit, $offset, $sorts, $filters);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
