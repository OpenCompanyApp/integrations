<?php

namespace OpenCompany\Integrations\Figma\Tools;

use OpenCompany\Integrations\Figma\FigmaService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Delete a comment from a Figma file.
 *
 * Permanently removes a comment by its ID.
 */
class FigmaDeleteComment implements Tool
{
    /**
     * @param  FigmaService  $service  The Figma API client
     */
    public function __construct(
        private FigmaService $service,
    ) {}

    public function name(): string
    {
        return 'figma_delete_comment';
    }

    public function description(): string
    {
        return 'Delete a comment from a Figma file.';
    }

    public function parameters(): array
    {
        return [
            'file_key'   => ['type' => 'string', 'required' => true, 'description' => 'The Figma file key.'],
            'comment_id' => ['type' => 'string', 'required' => true, 'description' => 'The comment ID to delete.'],
        ];
    }

    /**
     * Delete a comment from a Figma file.
     *
     * @param  array<string, mixed>  $args  Tool arguments (file_key, comment_id)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Figma integration is not configured.');
            }

            $fileKey = $args['file_key'] ?? '';
            $commentId = $args['comment_id'] ?? '';

            if (empty($fileKey)) {
                return ToolResult::error('file_key is required.');
            }
            if (empty($commentId)) {
                return ToolResult::error('comment_id is required.');
            }

            $this->service->deleteComment($fileKey, $commentId);

            return ToolResult::success([
                'deleted' => true,
                'comment_id' => $commentId,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
