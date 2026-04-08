<?php

namespace OpenCompany\Integrations\Wrike\Tools;

use OpenCompany\Integrations\Wrike\WrikeService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Create a new folder in Wrike.
 */
class WrikeCreateFolder implements Tool
{
    /**
     * @param  WrikeService  $service  The Wrike API client
     */
    public function __construct(
        private WrikeService $service,
    ) {}

    public function name(): string
    {
        return 'wrike_create_folder';
    }

    public function description(): string
    {
        return 'Create a new folder in Wrike.';
    }

    public function parameters(): array
    {
        return [
            'title'       => ['type' => 'string', 'required' => true,  'description' => 'Title of the folder.'],
            'parent_id'   => ['type' => 'string', 'description' => 'Parent folder or space ID to nest the folder under.'],
            'description' => ['type' => 'string', 'description' => 'Description of the folder.'],
        ];
    }

    /**
     * Create a new folder with the given details.
     *
     * @param  array<string, mixed>  $args  Tool arguments (title, parent_id, description)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Wrike integration is not configured.');
            }

            $title = $args['title'] ?? '';

            if (empty($title)) {
                return ToolResult::error('title is required.');
            }

            $data = ['title' => $title];

            if (isset($args['parent_id'])) {
                $data['parent'] = [$args['parent_id']];
            }
            if (isset($args['description'])) {
                $data['description'] = $args['description'];
            }

            $folder = $this->service->createFolder($data);

            return ToolResult::success($folder);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
