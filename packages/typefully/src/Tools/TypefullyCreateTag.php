<?php

namespace OpenCompany\Integrations\Typefully\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Typefully\TypefullyService;

/**
 * Create a Typefully tag for a social set.
 *
 * Tags can then be attached to drafts.
 */
class TypefullyCreateTag implements Tool
{
    /**
     * @param  TypefullyService  $service  The Typefully API client.
     */
    public function __construct(private TypefullyService $service) {}

    public function name(): string
    {
        return 'typefully_create_tag';
    }

    public function description(): string
    {
        return 'Create a tag for a Typefully social set.';
    }

    public function parameters(): array
    {
        return [
            'social_set_id' => ['type' => 'string', 'required' => true, 'description' => 'Typefully social set ID.'],
            'name' => ['type' => 'string', 'required' => true, 'description' => 'Tag display name.'],
        ];
    }

    /**
     * Create a tag.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Typefully integration is not configured.');
            }

            return ToolResult::success($this->service->createTag($args['social_set_id'] ?? '', $args['name'] ?? ''));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
