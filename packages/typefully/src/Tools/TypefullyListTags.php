<?php

namespace OpenCompany\Integrations\Typefully\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Typefully\TypefullyService;

/**
 * List Typefully tags for a social set.
 *
 * Tags can be used to organize and filter drafts.
 */
class TypefullyListTags implements Tool
{
    /**
     * @param  TypefullyService  $service  The Typefully API client.
     */
    public function __construct(private TypefullyService $service) {}

    public function name(): string
    {
        return 'typefully_list_tags';
    }

    public function description(): string
    {
        return 'List tags for a Typefully social set.';
    }

    public function parameters(): array
    {
        return [
            'social_set_id' => ['type' => 'string', 'required' => true, 'description' => 'Typefully social set ID.'],
            'limit' => ['type' => 'integer', 'description' => 'Maximum number of tags to return.'],
            'offset' => ['type' => 'integer', 'description' => 'Number of tags to skip.'],
        ];
    }

    /**
     * List tags.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Typefully integration is not configured.');
            }

            $socialSetId = $args['social_set_id'] ?? '';
            unset($args['social_set_id']);

            return ToolResult::success($this->service->listTags($socialSetId, $args));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
