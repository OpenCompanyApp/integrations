<?php

namespace OpenCompany\Integrations\Vero\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Vero\VeroService;

/**
 * Add and remove tags on a Vero user profile.
 *
 * Wraps Vero's single tag edit endpoint with explicit add and remove lists.
 */
class VeroEditTags implements Tool
{
    /**
     * @param  VeroService  $service  The Vero API service instance.
     */
    public function __construct(
        private VeroService $service,
    ) {}

    public function name(): string
    {
        return 'vero_edit_tags';
    }

    public function description(): string
    {
        return 'Add and/or remove tags on a Vero user profile using the official tag edit endpoint.';
    }

    public function parameters(): array
    {
        return [
            'id' => ['type' => 'string', 'required' => true, 'description' => 'Unique user identifier.'],
            'add' => ['type' => 'array', 'items' => ['type' => 'string'], 'description' => 'Tags to add.'],
            'remove' => ['type' => 'array', 'items' => ['type' => 'string'], 'description' => 'Tags to remove.'],
        ];
    }

    /**
     * Execute the edit tags tool.
     *
     * @param  array<string, mixed>  $args  Tool arguments (id, add, remove).
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Vero integration is not configured.');
            }

            $id = $args['id'] ?? '';
            $add = $args['add'] ?? [];
            $remove = $args['remove'] ?? [];

            if ($id === '') {
                return ToolResult::error('User ID is required.');
            }

            if ($add === [] && $remove === []) {
                return ToolResult::error('Provide at least one tag to add or remove.');
            }

            $result = $this->service->editTags($id, $add, $remove);

            return ToolResult::success([
                'id' => $id,
                'added' => $add,
                'removed' => $remove,
                'status' => $result['status'] ?? 200,
                'message' => $result['message'] ?? 'tags_updated',
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
