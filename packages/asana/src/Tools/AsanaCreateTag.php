<?php

namespace OpenCompany\Integrations\Asana\Tools;

use OpenCompany\Integrations\Asana\AsanaService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Create a new tag in Asana.
 */
class AsanaCreateTag implements Tool
{
    /**
     * @param  AsanaService  $service  The Asana API client
     */
    public function __construct(
        private AsanaService $service,
    ) {}

    public function name(): string
    {
        return 'asana_create_tag';
    }

    public function description(): string
    {
        return 'Create a new tag in Asana.';
    }

    public function parameters(): array
    {
        return [
            'name'      => ['type' => 'string', 'required' => true,  'description' => 'Name of the tag.'],
            'workspace' => ['type' => 'string', 'required' => true,  'description' => 'Workspace GID where the tag will be created.'],
            'color'     => ['type' => 'string', 'description' => 'Color for the tag (e.g. "dark-pink", "dark-green").'],
        ];
    }

    /**
     * Create a new tag with the given details.
     *
     * @param  array<string, mixed>  $args  Tool arguments (name, workspace, color)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Asana integration is not configured.');
            }

            $name = $args['name'] ?? '';
            $workspace = $args['workspace'] ?? '';

            if (empty($name)) {
                return ToolResult::error('name is required.');
            }
            if (empty($workspace)) {
                return ToolResult::error('workspace is required.');
            }

            $data = [
                'name' => $name,
                'workspace' => $workspace,
            ];

            if (isset($args['color'])) {
                $data['color'] = $args['color'];
            }

            $tag = $this->service->createTag($data);

            return ToolResult::success($tag);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
