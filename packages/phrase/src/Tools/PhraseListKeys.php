<?php

namespace OpenCompany\Integrations\Phrase\Tools;

use OpenCompany\Integrations\Phrase\PhraseService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List translation keys in a Phrase project.
 */
class PhraseListKeys implements Tool
{
    /**
     * @param  PhraseService  $service  The Phrase API client
     */
    public function __construct(
        private PhraseService $service,
    ) {}

    public function name(): string
    {
        return 'phrase_list_keys';
    }

    public function description(): string
    {
        return <<<'MD'
        List translation keys in a Phrase project. Optionally filter by name using
        the query parameter, and control pagination with page and per_page.
        Returns key IDs, names, and creation dates.
        MD;
    }

    public function parameters(): array
    {
        return [
            'project_id' => ['type' => 'string', 'description' => 'The project ID.', 'required' => true],
            'page' => ['type' => 'integer', 'description' => 'Page number (default 1).'],
            'per_page' => ['type' => 'integer', 'description' => 'Number of keys per page (default 25, max 100).'],
            'q' => ['type' => 'string', 'description' => 'Search query to filter keys by name.'],
        ];
    }

    /**
     * List translation keys in a project.
     *
     * @param  array<string, mixed>  $args  Tool arguments (project_id, page, per_page, q)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Phrase integration is not configured.');
            }

            $projectId = $args['project_id'] ?? '';

            if (empty($projectId)) {
                return ToolResult::error('Project ID is required.');
            }

            $params = [];

            if (isset($args['page'])) {
                $params['page'] = (int) $args['page'];
            }

            if (isset($args['per_page'])) {
                $params['per_page'] = min((int) $args['per_page'], 100);
            }

            if (isset($args['q']) && ! empty($args['q'])) {
                $params['q'] = $args['q'];
            }

            $result = $this->service->listKeys($projectId, $params);

            if (empty($result)) {
                return ToolResult::success('No keys found.');
            }

            $output = [];
            foreach ($result as $key) {
                $output[] = [
                    'id' => $key['id'] ?? '',
                    'name' => $key['name'] ?? '',
                    'created_at' => $key['created_at'] ?? null,
                    'updated_at' => $key['updated_at'] ?? null,
                ];
            }

            return ToolResult::success([
                'items' => $output,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
