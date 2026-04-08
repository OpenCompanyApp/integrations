<?php

namespace OpenCompany\Integrations\Apify\Tools;

use OpenCompany\Integrations\Apify\ApifyService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get details of a specific Apify actor.
 *
 * Returns the actor's configuration, input schema, and default run options.
 * Useful for understanding what input an actor expects before running it.
 */
class ApifyGetActor implements Tool
{
    public function __construct(
        private ApifyService $service,
    ) {}

    public function name(): string
    {
        return 'apify_get_actor';
    }

    public function description(): string
    {
        return 'Get details of a specific Apify actor, including its description, input schema, default run options, and available versions. Use this to understand what input an actor requires before running it.';
    }

    public function parameters(): array
    {
        return [
            'actorId' => ['type' => 'string', 'required' => true, 'description' => 'The actor ID (e.g., "apify/web-scraper") or numeric ID.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Apify integration is not configured.');
            }

            $result = $this->service->getActor($args['actorId']);

            $data = $result['data'] ?? $result;

            return ToolResult::success([
                'id' => $data['id'] ?? null,
                'username' => $data['username'] ?? null,
                'name' => $data['name'] ?? null,
                'fullName' => ($data['username'] ?? '') . '/' . ($data['name'] ?? ''),
                'description' => $data['description'] ?? null,
                'versions' => $data['versions'] ?? null,
                'defaultRunOptions' => $data['defaultRunOptions'] ?? null,
                'inputSchema' => $data['inputSchema'] ?? null,
                'exampleRunInput' => $data['exampleRunInput'] ?? null,
                'isPublic' => $data['isPublic'] ?? null,
                'createdAt' => $data['createdAt'] ?? null,
                'updatedAt' => $data['updatedAt'] ?? null,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
