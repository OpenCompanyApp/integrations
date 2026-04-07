<?php

namespace OpenCompany\Integrations\Phrase\Tools;

use OpenCompany\Integrations\Phrase\PhraseService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List translations in a Phrase project.
 */
class PhraseListTranslations implements Tool
{
    /**
     * @param  PhraseService  $service  The Phrase API client
     */
    public function __construct(
        private PhraseService $service,
    ) {}

    public function name(): string
    {
        return 'phrase_list_translations';
    }

    public function description(): string
    {
        return <<<'MD'
        List translations in a Phrase project. Optionally filter by key ID or locale ID,
        and control pagination with page and per_page.
        Returns translation content, key names, and locale codes.
        MD;
    }

    public function parameters(): array
    {
        return [
            'project_id' => ['type' => 'string', 'description' => 'The project ID.', 'required' => true],
            'page' => ['type' => 'integer', 'description' => 'Page number (default 1).'],
            'per_page' => ['type' => 'integer', 'description' => 'Number of translations per page (default 25, max 100).'],
            'key_id' => ['type' => 'string', 'description' => 'Filter translations by key ID.'],
            'locale_id' => ['type' => 'string', 'description' => 'Filter translations by locale ID.'],
            'q' => ['type' => 'string', 'description' => 'Search query to filter translations.'],
        ];
    }

    /**
     * List translations in a project.
     *
     * @param  array<string, mixed>  $args  Tool arguments (project_id, page, per_page, key_id, locale_id, q)
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

            if (isset($args['key_id']) && ! empty($args['key_id'])) {
                $params['key_id'] = $args['key_id'];
            }

            if (isset($args['locale_id']) && ! empty($args['locale_id'])) {
                $params['locale_id'] = $args['locale_id'];
            }

            if (isset($args['q']) && ! empty($args['q'])) {
                $params['q'] = $args['q'];
            }

            $result = $this->service->listTranslations($projectId, $params);

            if (empty($result)) {
                return ToolResult::success('No translations found.');
            }

            $output = [];
            foreach ($result as $translation) {
                $output[] = [
                    'id' => $translation['id'] ?? '',
                    'content' => $translation['content'] ?? '',
                    'key' => [
                        'id' => $translation['key']['id'] ?? '',
                        'name' => $translation['key']['name'] ?? '',
                    ],
                    'locale' => [
                        'id' => $translation['locale']['id'] ?? '',
                        'code' => $translation['locale']['code'] ?? '',
                    ],
                    'unverified' => $translation['unverified'] ?? false,
                    'created_at' => $translation['created_at'] ?? null,
                    'updated_at' => $translation['updated_at'] ?? null,
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
