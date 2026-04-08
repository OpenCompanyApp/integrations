<?php

namespace OpenCompany\Integrations\Lokalise\Tools;

use OpenCompany\Integrations\Lokalise\LokaliseService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class LokaliseGetKey implements Tool
{
    public function __construct(
        private LokaliseService $service,
    ) {}

    public function name(): string
    {
        return 'lokalise_get_key';
    }

    public function description(): string
    {
        return 'Get details of a specific translation key in a Lokalise project. Returns key name, platforms, translations, and other metadata.';
    }

    public function parameters(): array
    {
        return [
            'project_id' => ['type' => 'string', 'required' => true, 'description' => 'The project ID.'],
            'key_id' => ['type' => 'integer', 'required' => true, 'description' => 'The key ID.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Lokalise integration is not configured.');
            }

            $projectId = $args['project_id'];
            $keyId = $args['key_id'];
            $result = $this->service->getKey($projectId, $keyId);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
