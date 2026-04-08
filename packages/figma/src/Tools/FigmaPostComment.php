<?php

namespace OpenCompany\Integrations\Figma\Tools;

use OpenCompany\Integrations\Figma\FigmaService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Post a comment on a Figma file.
 *
 * Creates a new comment or a reply to an existing comment.
 * Supports positioning via client_meta coordinates.
 */
class FigmaPostComment implements Tool
{
    /**
     * @param  FigmaService  $service  The Figma API client
     */
    public function __construct(
        private FigmaService $service,
    ) {}

    public function name(): string
    {
        return 'figma_post_comment';
    }

    public function description(): string
    {
        return 'Post a comment on a Figma file. Can be a top-level comment or a reply.';
    }

    public function parameters(): array
    {
        return [
            'file_key'    => ['type' => 'string', 'required' => true, 'description' => 'The Figma file key.'],
            'message'     => ['type' => 'string', 'required' => true, 'description' => 'The comment text.'],
            'client_meta' => ['type' => 'string', 'description' => 'JSON object with position metadata (x, y) for the comment.'],
            'comment_id'  => ['type' => 'string', 'description' => 'If provided, this comment is a reply to the given comment ID.'],
        ];
    }

    /**
     * Post a comment on a Figma file.
     *
     * @param  array<string, mixed>  $args  Tool arguments (file_key, message, client_meta, comment_id)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Figma integration is not configured.');
            }

            $fileKey = $args['file_key'] ?? '';
            $message = $args['message'] ?? '';

            if (empty($fileKey)) {
                return ToolResult::error('file_key is required.');
            }
            if (empty($message)) {
                return ToolResult::error('message is required.');
            }

            $data = ['message' => $message];

            if (isset($args['client_meta'])) {
                $meta = $args['client_meta'];
                $data['client_meta'] = is_string($meta) ? json_decode($meta, true) : $meta;
            }
            if (! empty($args['comment_id'])) {
                $data['comment_id'] = $args['comment_id'];
            }

            $result = $this->service->postComment($fileKey, $data);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
