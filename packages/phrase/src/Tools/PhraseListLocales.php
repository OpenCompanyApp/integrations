<?php

namespace OpenCompany\Integrations\Phrase\Tools;

use OpenCompany\Integrations\Phrase\PhraseService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List locales in a Phrase project.
 */
class PhraseListLocales implements Tool
{
    /**
     * @param  PhraseService  $service  The Phrase API client
     */
    public function __construct(
        private PhraseService $service,
    ) {}

    public function name(): string
    {
        return 'phrase_list_locales';
    }

    public function description(): string
    {
        return <<<'MD'
        List locales in a Phrase project. Returns locale IDs, codes, names,
        and default status.
        MD;
    }

    public function parameters(): array
    {
        return [
            'project_id' => ['type' => 'string', 'description' => 'The project ID.', 'required' => true],
            'page' => ['type' => 'integer', 'description' => 'Page number (default 1).'],
            'per_page' => ['type' => 'integer', 'description' => 'Number of locales per page (default 25, max 100).'],
        ];
    }

    /**
     * List locales in a project.
     *
     * @param  array<string, mixed>  $args  Tool arguments (project_id, page, per_page)
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

            $result = $this->service->listLocales($projectId, $params);

            if (empty($result)) {
                return ToolResult::success('No locales found.');
            }

            $output = [];
            foreach ($result as $locale) {
                $output[] = [
                    'id' => $locale['id'] ?? '',
                    'code' => $locale['code'] ?? '',
                    'name' => $locale['name'] ?? '',
                    'default' => $locale['default'] ?? false,
                    'rtl' => $locale['rtl'] ?? false,
                    'created_at' => $locale['created_at'] ?? null,
                    'updated_at' => $locale['updated_at'] ?? null,
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
