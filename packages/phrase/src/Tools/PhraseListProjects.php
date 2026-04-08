<?php

namespace OpenCompany\Integrations\Phrase\Tools;

use OpenCompany\Integrations\Phrase\PhraseService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List all Phrase projects the authenticated user has access to.
 */
class PhraseListProjects implements Tool
{
    /**
     * @param  PhraseService  $service  The Phrase API client
     */
    public function __construct(
        private PhraseService $service,
    ) {}

    public function name(): string
    {
        return 'phrase_list_projects';
    }

    public function description(): string
    {
        return <<<'MD'
        List all Phrase projects the authenticated user has access to.
        Returns project IDs, names, main formats, and locale counts.
        MD;
    }

    public function parameters(): array
    {
        return [
            'page' => ['type' => 'integer', 'description' => 'Page number (default 1).'],
            'per_page' => ['type' => 'integer', 'description' => 'Number of projects per page (default 25, max 100).'],
        ];
    }

    /**
     * List Phrase projects.
     *
     * @param  array<string, mixed>  $args  Tool arguments (page, per_page)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Phrase integration is not configured.');
            }

            $params = [];

            if (isset($args['page'])) {
                $params['page'] = (int) $args['page'];
            }

            if (isset($args['per_page'])) {
                $params['per_page'] = min((int) $args['per_page'], 100);
            }

            $result = $this->service->listProjects($params);

            if (empty($result)) {
                return ToolResult::success('No projects found.');
            }

            $output = [];
            foreach ($result as $project) {
                $output[] = [
                    'id' => $project['id'] ?? '',
                    'name' => $project['name'] ?? '',
                    'slug' => $project['slug'] ?? '',
                    'main_format' => $project['main_format'] ?? '',
                    'created_at' => $project['created_at'] ?? null,
                    'updated_at' => $project['updated_at'] ?? null,
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
