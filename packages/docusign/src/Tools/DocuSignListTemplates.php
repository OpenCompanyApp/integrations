<?php

namespace OpenCompany\Integrations\DocuSign\Tools;

use OpenCompany\Integrations\DocuSign\DocuSignService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List templates available in the DocuSign account.
 *
 * Returns template summaries including IDs, names, and folder locations.
 */
class DocuSignListTemplates implements Tool
{
    /**
     * Create a new DocuSignListTemplates tool instance.
     */
    public function __construct(
        private DocuSignService $service,
    ) {}

    /**
     * The unique tool identifier.
     */
    public function name(): string
    {
        return 'docusign_list_templates';
    }

    /**
     * A human-readable description of what the tool does.
     */
    public function description(): string
    {
        return 'List templates available in the DocuSign account. Templates define reusable envelope structures with pre-configured documents, recipients, and signing tabs. Use a template ID to create envelopes from a template.';
    }

    /**
     * Define the parameters this tool accepts.
     *
     * @return array<string, array{type: string, required?: bool, description: string}>
     */
    public function parameters(): array
    {
        return [
            'search_text' => ['type' => 'string', 'description' => 'Filter templates by name or description.'],
            'count' => ['type' => 'integer', 'description' => 'Number of results to return (default: 25).'],
            'start_position' => ['type' => 'integer', 'description' => 'Zero-based index for pagination (default: 0).'],
            'folder_id' => ['type' => 'string', 'description' => 'Filter by folder ID.'],
            'folder_ids' => ['type' => 'array', 'description' => 'Filter by multiple folder IDs.'],
            'order' => ['type' => 'string', 'description' => 'Sort direction: "asc" or "desc".'],
            'order_by' => ['type' => 'string', 'description' => 'Sort field: "name" or "modified".'],
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
                return ToolResult::error('DocuSign integration is not configured.');
            }

            $params = [];
            $stringParams = ['search_text', 'folder_id', 'order', 'order_by'];
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
            if (isset($args['folder_ids'])) {
                $params['folder_ids'] = $args['folder_ids'];
            }

            $result = $this->service->listTemplates($params);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
