<?php

namespace OpenCompany\Integrations\Contentful\Tools;

use OpenCompany\Integrations\Contentful\ContentfulService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get details about the connected Contentful space.
 */
class ContentfulGetSpace implements Tool
{
    /**
     * @param  ContentfulService  $service  The Contentful API client
     */
    public function __construct(
        private ContentfulService $service,
    ) {}

    public function name(): string
    {
        return 'contentful_get_space';
    }

    public function description(): string
    {
        return <<<'MD'
        Get details about the connected Contentful space, including name, locales,
        organization, and space type.
        MD;
    }

    public function parameters(): array
    {
        return [];
    }

    /**
     * Get the connected space's details.
     *
     * @param  array<string, mixed>  $args  Tool arguments (none)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Contentful integration is not configured.');
            }

            $result = $this->service->getSpace();

            $locales = [];
            foreach ($result['locales'] ?? [] as $locale) {
                $locales[] = [
                    'code' => $locale['code'] ?? '',
                    'name' => $locale['name'] ?? '',
                    'default' => $locale['default'] ?? false,
                ];
            }

            return ToolResult::success([
                'id' => $result['sys']['id'] ?? '',
                'name' => $result['name'] ?? '',
                'type' => $result['type'] ?? '',
                'organization' => [
                    'id' => $result['sys']['organization']['sys']['id'] ?? '',
                    'name' => $result['organization']['name'] ?? '',
                ],
                'locales' => $locales,
                'created_at' => $result['sys']['createdAt'] ?? null,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
