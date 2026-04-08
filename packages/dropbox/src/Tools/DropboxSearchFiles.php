<?php

namespace OpenCompany\Integrations\Dropbox\Tools;

use OpenCompany\Integrations\Dropbox\DropboxService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Search for files and folders in Dropbox.
 */
class DropboxSearchFiles implements Tool
{
    /** @param  DropboxService  $service  The Dropbox API client */
    public function __construct(
        private DropboxService $service,
    ) {}

    public function name(): string
    {
        return 'dropbox_search_files';
    }

    public function description(): string
    {
        return 'Search for files and folders in Dropbox by name or content. Returns matching entries with metadata. Optionally filter by path or file category. If has_more is true, use dropbox_search_continue with the cursor.';
    }

    public function parameters(): array
    {
        return [
            'query' => ['type' => 'string', 'required' => true, 'description' => 'The search query string.'],
            'path' => ['type' => 'string', 'description' => 'Optional path to scope the search, e.g. "/Documents".'],
            'file_categories' => ['type' => 'array', 'description' => 'Filter by file categories, e.g. ["document", "image"]. Possible values: document, image, pdf, spreadsheet, presentation, audio, video, folder, paper.'],
            'max_results' => ['type' => 'integer', 'description' => 'Maximum number of results to return (1-1000). Default: 100.'],
        ];
    }

    /**
     * Search for files and folders in Dropbox.
     *
     * @param  array<string, mixed>  $args  Tool arguments (query, path, file_categories, max_results)
     */
    public function execute(array $args): ToolResult
    {
        if (! $this->service->isConfigured()) {
            return ToolResult::error('Dropbox is not configured. Missing access token.');
        }

        $query = $args['query'] ?? '';

        if (empty($query)) {
            return ToolResult::error('A search query is required.');
        }

        try {
            $params = ['query' => $query];

            if (isset($args['path'])) {
                $params['options']['path'] = $args['path'];
            }
            if (isset($args['file_categories'])) {
                $params['options']['file_categories'] = $args['file_categories'];
            }
            if (isset($args['max_results'])) {
                $params['options']['max_results'] = $args['max_results'];
            }

            $result = $this->service->searchFiles($params);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
