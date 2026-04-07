<?php

namespace OpenCompany\Integrations\BuilderIo\Tools;

use OpenCompany\Integrations\BuilderIo\BuilderIoService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get a single content entry by ID from Builder.io.
 */
class BuilderIoGetContent implements Tool
{
    /**
     * @param  BuilderIoService  $service  The Builder.io API client
     */
    public function __construct(
        private BuilderIoService $service,
    ) {}

    public function name(): string
    {
        return 'builder_io_get_content';
    }

    public function description(): string
    {
        return <<<'MD'
        Get detailed information about a specific Builder.io content entry by its ID.
        Returns the full entry data, model reference, and timestamps.
        MD;
    }

    public function parameters(): array
    {
        return [
            'content_id' => ['type' => 'string', 'required' => true, 'description' => 'The ID of the content entry to retrieve.'],
        ];
    }

    /**
     * Get a content entry by ID.
     *
     * @param  array<string, mixed>  $args  Tool arguments (content_id)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Builder.io integration is not configured.');
            }

            $contentId = $args['content_id'] ?? '';

            if (empty($contentId)) {
                return ToolResult::error('content_id is required.');
            }

            $result = $this->service->getContent($contentId);

            return ToolResult::success([
                'id' => $result['id'] ?? '',
                'name' => $result['name'] ?? '',
                'model' => $result['modelId'] ?? $result['model'] ?? null,
                'created_at' => $result['createdDate'] ?? $result['created_at'] ?? null,
                'updated_at' => $result['lastUpdatedDate'] ?? $result['updated_at'] ?? null,
                'data' => $result['data'] ?? [],
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
