<?php

namespace OpenCompany\Integrations\Phrase\Tools;

use OpenCompany\Integrations\Phrase\PhraseService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get a single translation key by ID.
 */
class PhraseGetKey implements Tool
{
    /**
     * @param  PhraseService  $service  The Phrase API client
     */
    public function __construct(
        private PhraseService $service,
    ) {}

    public function name(): string
    {
        return 'phrase_get_key';
    }

    public function description(): string
    {
        return <<<'MD'
        Get a single translation key by ID, including its name, description,
        tags, and plural settings.
        MD;
    }

    public function parameters(): array
    {
        return [
            'project_id' => ['type' => 'string', 'description' => 'The project ID.', 'required' => true],
            'key_id' => ['type' => 'string', 'description' => 'The key ID.', 'required' => true],
        ];
    }

    /**
     * Get a single translation key.
     *
     * @param  array<string, mixed>  $args  Tool arguments (project_id, key_id)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Phrase integration is not configured.');
            }

            $projectId = $args['project_id'] ?? '';
            $keyId = $args['key_id'] ?? '';

            if (empty($projectId)) {
                return ToolResult::error('Project ID is required.');
            }

            if (empty($keyId)) {
                return ToolResult::error('Key ID is required.');
            }

            $result = $this->service->getKey($projectId, $keyId);

            return ToolResult::success([
                'id' => $result['id'] ?? '',
                'name' => $result['name'] ?? '',
                'description' => $result['description'] ?? null,
                'tags' => $result['tags'] ?? [],
                'plural' => $result['plural'] ?? false,
                'created_at' => $result['created_at'] ?? null,
                'updated_at' => $result['updated_at'] ?? null,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
