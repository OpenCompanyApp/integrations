<?php

namespace OpenCompany\Integrations\Bubble\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Bubble\BubbleService;

/**
 * Replace a Bubble record.
 *
 * Uses the Data API PUT endpoint with the supplied full field payload.
 */
class BubbleReplaceRecord implements Tool
{
    /**
     * @param  BubbleService  $service  The Bubble API service client
     */
    public function __construct(private BubbleService $service) {}

    public function name(): string
    {
        return 'bubble_replace_record';
    }

    public function description(): string
    {
        return 'Replace a Bubble record by data type and ID using the Data API PUT endpoint.';
    }

    public function parameters(): array
    {
        return [
            'type' => ['type' => 'string', 'required' => true, 'description' => 'Bubble data type name.'],
            'id' => ['type' => 'string', 'required' => true, 'description' => 'Bubble unique ID.'],
            'fields' => ['type' => 'object', 'required' => true, 'description' => 'Full field payload for the record.'],
        ];
    }

    /**
     * Replace record fields.
     *
     * @param  array<string, mixed>  $args  Tool arguments
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Bubble integration is not configured.');
            }

            $fields = $args['fields'] ?? [];
            if (is_string($fields)) {
                $fields = json_decode($fields, true);
            }
            if (! is_array($fields)) {
                return ToolResult::error('The "fields" parameter must be an object or JSON object string.');
            }

            return ToolResult::success($this->service->replaceRecord((string) ($args['type'] ?? ''), (string) ($args['id'] ?? ''), $fields));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
