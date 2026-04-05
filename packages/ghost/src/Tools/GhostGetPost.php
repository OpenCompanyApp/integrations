<?php

namespace OpenCompany\Integrations\Ghost\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Ghost\GhostService;

class GhostGetPost implements Tool
{
    public function __construct(
        private GhostService $service,
    ) {}

    public function name(): string
    {
        return 'ghost_get_post';
    }

    public function description(): string
    {
        return 'Get a single Ghost blog post by ID. Returns full post content, metadata, tags, and authors.';
    }

    public function parameters(): array
    {
        return [
            'id' => [
                'type' => 'string',
                'required' => true,
                'description' => 'The post UUID.',
            ],
            'fields' => [
                'type' => 'string',
                'description' => 'Comma-separated list of fields to return (e.g. "id,title,html,status").',
            ],
            'include' => [
                'type' => 'string',
                'description' => 'Comma-separated related data to include: "tags", "authors", "tags,authors".',
            ],
            'formats' => [
                'type' => 'string',
                'description' => 'Content formats to return: "html", "plaintext", "mobiledoc" (default: "html").',
            ],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Ghost integration is not configured. Provide an Admin API key and base URL.');
            }

            $id = $args['id'] ?? '';
            if (empty($id)) {
                return ToolResult::error('Post ID is required.');
            }

            $params = [];
            if (! empty($args['fields'])) {
                $params['fields'] = $args['fields'];
            }
            if (! empty($args['include'])) {
                $params['include'] = $args['include'];
            }
            if (! empty($args['formats'])) {
                $params['formats'] = $args['formats'];
            }

            $result = $this->service->getPost($id, $params);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
