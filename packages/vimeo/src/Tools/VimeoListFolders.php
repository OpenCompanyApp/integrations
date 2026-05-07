<?php

namespace OpenCompany\Integrations\Vimeo\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Vimeo\VimeoService;

/**
 * List folders (projects) for the authenticated Vimeo user.
 *
 * Returns paginated folder listings with metadata like name, description,
 * and subfolder/video counts.
 */
class VimeoListFolders implements Tool
{
    /**
     * @param  VimeoService  $service  The Vimeo API client.
     */
    public function __construct(
        private VimeoService $service,
    ) {}

    public function name(): string
    {
        return 'vimeo_list_folders';
    }

    public function description(): string
    {
        return 'List folders (projects) for the authenticated Vimeo user. Supports pagination and query search. Returns folder names, descriptions, and item counts.';
    }

    public function parameters(): array
    {
        return [
            'per_page' => ['type' => 'integer', 'description' => 'Number of folders per page (1-100, default: 25).'],
            'page' => ['type' => 'integer', 'description' => 'Page number for pagination (default: 1).'],
            'query' => ['type' => 'string', 'description' => 'Search query to filter folders by name.'],
        ];
    }

    /**
     * List folders.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Vimeo integration is not configured.');
            }

            $params = [];

            if (isset($args['per_page'])) {
                $params['per_page'] = min(max((int) $args['per_page'], 1), 100);
            }
            if (isset($args['page'])) {
                $params['page'] = max((int) $args['page'], 1);
            }
            if (isset($args['query'])) {
                $params['query'] = $args['query'];
            }

            $result = $this->service->listFolders($params);

            $folders = $result['data'] ?? [];
            $paging = $result['paging'] ?? [];

            return ToolResult::success([
                'folders' => array_map(function (array $folder) {
                    return [
                        'id' => basename($folder['uri'] ?? ''),
                        'uri' => $folder['uri'] ?? '',
                        'name' => $folder['name'] ?? '',
                        'description' => $folder['description'] ?? '',
                        'created_time' => $folder['created_time'] ?? null,
                        'modified_time' => $folder['modified_time'] ?? null,
                        'metadata' => [
                            'connections' => [
                                'videos' => $folder['metadata']['connections']['videos']['total'] ?? null,
                                'subfolders' => $folder['metadata']['connections']['subfolders']['total'] ?? null,
                            ],
                        ],
                    ];
                }, $folders),
                'total' => $result['total'] ?? count($folders),
                'page' => $params['page'] ?? 1,
                'per_page' => $params['per_page'] ?? 25,
                'paging' => [
                    'next' => $paging['next'] ?? null,
                    'previous' => $paging['previous'] ?? null,
                    'first' => $paging['first'] ?? null,
                    'last' => $paging['last'] ?? null,
                ],
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
