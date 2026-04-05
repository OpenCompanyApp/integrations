<?php

namespace OpenCompany\Integrations\ClickUp\Tools;

use OpenCompany\Integrations\ClickUp\ClickUpService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class ClickUpGetHierarchy implements Tool
{
    public function __construct(
        private ClickUpService $service,
    ) {}

    public function name(): string
    {
        return 'clickup_get_hierarchy';
    }

    public function description(): string
    {
        return <<<'MD'
        Get the ClickUp workspace hierarchy — spaces, folders, and lists.
        Returns a tree structure with IDs and names for navigation.
        Optionally filter to specific space IDs.
        MD;
    }

    public function parameters(): array
    {
        return [
            'workspace_id' => ['type' => 'string', 'description' => 'Workspace/team ID. Uses configured default if omitted.'],
            'space_ids' => ['type' => 'string', 'description' => 'Comma-separated space IDs to filter. Omit to get all spaces.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('ClickUp integration is not configured.');
            }

            $workspaceId = $args['workspace_id'] ?? $this->service->getWorkspaceId();

            if (empty($workspaceId)) {
                // Auto-detect from teams endpoint
                $teams = $this->service->getTeams();
                $teamList = $teams['teams'] ?? [];
                if (empty($teamList)) {
                    return ToolResult::error('No workspaces found. Check your API token.');
                }
                $workspaceId = $teamList[0]['id'];
            }

            $spacesResponse = $this->service->getSpaces($workspaceId);
            $spaces = $spacesResponse['spaces'] ?? [];

            // Optional filter
            $filterSpaceIds = isset($args['space_ids'])
                ? (is_string($args['space_ids']) ? explode(',', $args['space_ids']) : $args['space_ids'])
                : null;

            $tree = [];
            foreach ($spaces as $space) {
                if ($filterSpaceIds && ! in_array($space['id'], $filterSpaceIds)) {
                    continue;
                }

                $spaceNode = [
                    'id' => $space['id'],
                    'name' => $space['name'],
                    'folders' => [],
                    'lists' => [],
                ];

                // Get folders
                $foldersResponse = $this->service->getFolders($space['id']);
                foreach ($foldersResponse['folders'] ?? [] as $folder) {
                    $folderNode = [
                        'id' => $folder['id'],
                        'name' => $folder['name'],
                        'lists' => [],
                    ];

                    foreach ($folder['lists'] ?? [] as $list) {
                        $folderNode['lists'][] = [
                            'id' => $list['id'],
                            'name' => $list['name'],
                        ];
                    }

                    $spaceNode['folders'][] = $folderNode;
                }

                // Get folderless lists
                $listsResponse = $this->service->getSpaceLists($space['id']);
                foreach ($listsResponse['lists'] ?? [] as $list) {
                    $spaceNode['lists'][] = [
                        'id' => $list['id'],
                        'name' => $list['name'],
                    ];
                }

                $tree[] = $spaceNode;
            }

            return ToolResult::success(['workspace_id' => $workspaceId, 'spaces' => $tree]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
