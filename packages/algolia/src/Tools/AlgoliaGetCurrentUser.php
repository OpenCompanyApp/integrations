<?php

namespace OpenCompany\Integrations\Algolia\Tools;

use OpenCompany\Integrations\Algolia\AlgoliaService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List API keys to verify authentication with the Algolia API.
 */
class AlgoliaGetCurrentUser implements Tool
{
    public function __construct(
        private AlgoliaService $service,
    ) {}

    public function name(): string
    {
        return 'algolia_get_current_user';
    }

    public function description(): string
    {
        return 'List API keys for the Algolia application. Use this to verify that authentication is working and to see which API keys exist.';
    }

    public function parameters(): array
    {
        return [];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Algolia integration is not configured.');
            }

            $result = $this->service->listApiKeys();

            $keys = $result['keys'] ?? [];

            return ToolResult::success([
                'applicationId' => $this->service->getAppId(),
                'keyCount' => count($keys),
                'keys' => array_map(function (array $key) {
                    return [
                        'value' => substr($key['value'] ?? '', 0, 8) . '...',
                        'description' => $key['description'] ?? null,
                        'type' => $key['type'] ?? null,
                        'acl' => $key['acl'] ?? [],
                        'validity' => $key['validity'] ?? null,
                        'createdAt' => $key['createdAt'] ?? null,
                    ];
                }, $keys),
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
