<?php

namespace OpenCompany\Integrations\Typefully\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Typefully\TypefullyService;

/**
 * Get Typefully media processing status.
 *
 * Returns status and media URLs for an uploaded media item.
 */
class TypefullyGetMedia implements Tool
{
    /**
     * @param  TypefullyService  $service  The Typefully API client.
     */
    public function __construct(private TypefullyService $service) {}

    public function name(): string
    {
        return 'typefully_get_media';
    }

    public function description(): string
    {
        return 'Get processing status and URLs for Typefully media by media ID.';
    }

    public function parameters(): array
    {
        return [
            'social_set_id' => ['type' => 'string', 'required' => true, 'description' => 'Typefully social set ID.'],
            'media_id' => ['type' => 'string', 'required' => true, 'description' => 'Typefully media ID.'],
        ];
    }

    /**
     * Get media status.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Typefully integration is not configured.');
            }

            return ToolResult::success($this->service->getMedia($args['social_set_id'] ?? '', $args['media_id'] ?? ''));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
