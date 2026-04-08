<?php

namespace OpenCompany\Integrations\Confluence\Tools;

use OpenCompany\Integrations\Confluence\ConfluenceService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Add labels to a Confluence page.
 */
class ConfluenceAddLabels implements Tool
{
    /** @param  ConfluenceService  $service  The Confluence API client */
    public function __construct(
        private ConfluenceService $service,
    ) {}

    public function name(): string
    {
        return 'confluence_add_labels';
    }

    public function description(): string
    {
        return 'Add one or more labels to a Confluence page. Labels are provided as an array of name strings.';
    }

    public function parameters(): array
    {
        return [
            'page_id' => ['type' => 'string', 'required' => true, 'description' => 'The content ID of the page.'],
            'labels' => ['type' => 'array', 'required' => true, 'description' => 'Array of label name strings to add. Example: ["documentation", "api"].'],
        ];
    }

    /**
     * Add labels to the specified Confluence page.
     *
     * @param  array<string, mixed>  $args  Tool arguments (page_id, labels)
     */
    public function execute(array $args): ToolResult
    {
        if (! $this->service->isConfigured()) {
            return ToolResult::error('Confluence is not configured. Missing API token.');
        }

        $pageId = $args['page_id'] ?? '';
        $labels = $args['labels'] ?? [];

        if (empty($pageId)) {
            return ToolResult::error('Page ID is required.');
        }

        if (empty($labels) || ! is_array($labels)) {
            return ToolResult::error('Labels array is required and must not be empty.');
        }

        try {
            $labelPayload = array_map(fn (string $name) => [
                'prefix' => 'global',
                'name' => $name,
            ], $labels);

            $result = $this->service->addLabels($pageId, $labelPayload);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
