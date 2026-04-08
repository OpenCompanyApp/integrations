<?php

namespace OpenCompany\Integrations\Lokalise\Tools;

use OpenCompany\Integrations\Lokalise\LokaliseService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class LokaliseCreateKey implements Tool
{
    public function __construct(
        private LokaliseService $service,
    ) {}

    public function name(): string
    {
        return 'lokalise_create_key';
    }

    public function description(): string
    {
        return 'Create a new translation key in a Lokalise project. The key name and optional translations for each language can be provided.';
    }

    public function parameters(): array
    {
        return [
            'project_id' => ['type' => 'string', 'required' => true, 'description' => 'The project ID.'],
            'key_name' => ['type' => 'string', 'required' => true, 'description' => 'The key name (e.g. "app.welcome").'],
            'platforms' => ['type' => 'array', 'description' => 'List of platforms (e.g. ["web", "ios", "android"]).'],
            'translations' => ['type' => 'object', 'description' => 'Key-value map of language ISO codes to translation values (e.g. {"en": "Welcome", "fr": "Bienvenue"}).'],
            'description' => ['type' => 'string', 'description' => 'Description for the key.'],
            'tags' => ['type' => 'array', 'description' => 'List of tags to assign to the key.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Lokalise integration is not configured.');
            }

            $projectId = $args['project_id'];
            $keyData = [
                'key_name' => $args['key_name'],
            ];

            if (isset($args['platforms'])) {
                $keyData['platforms'] = $args['platforms'];
            }
            if (isset($args['translations'])) {
                $keyData['translations'] = $args['translations'];
            }
            if (isset($args['description'])) {
                $keyData['description'] = $args['description'];
            }
            if (isset($args['tags'])) {
                $keyData['tags'] = $args['tags'];
            }

            $result = $this->service->createKey($projectId, $keyData);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
