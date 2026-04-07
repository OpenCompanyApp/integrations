<?php

namespace OpenCompany\Integrations\Phrase\Tools;

use OpenCompany\Integrations\Phrase\PhraseService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get details of a single Phrase project.
 */
class PhraseGetProject implements Tool
{
    /**
     * @param  PhraseService  $service  The Phrase API client
     */
    public function __construct(
        private PhraseService $service,
    ) {}

    public function name(): string
    {
        return 'phrase_get_project';
    }

    public function description(): string
    {
        return <<<'MD'
        Get details of a single Phrase project including name, slug, main format,
        default locale, and shares.
        MD;
    }

    public function parameters(): array
    {
        return [
            'project_id' => ['type' => 'string', 'description' => 'The ID of the project to retrieve.', 'required' => true],
        ];
    }

    /**
     * Get a Phrase project by ID.
     *
     * @param  array<string, mixed>  $args  Tool arguments (project_id)
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

            $result = $this->service->getProject($projectId);

            return ToolResult::success([
                'id' => $result['id'] ?? '',
                'name' => $result['name'] ?? '',
                'slug' => $result['slug'] ?? '',
                'main_format' => $result['main_format'] ?? '',
                'project_image_url' => $result['project_image_url'] ?? null,
                'created_at' => $result['created_at'] ?? null,
                'updated_at' => $result['updated_at'] ?? null,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
