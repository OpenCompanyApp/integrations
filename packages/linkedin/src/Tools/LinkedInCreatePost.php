<?php

namespace OpenCompany\Integrations\Linkedin\Tools;

use OpenCompany\Integrations\Linkedin\LinkedinService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Create a new LinkedIn UGC post.
 *
 * Creates a post on behalf of an author with text content.
 */
class LinkedinCreatePost implements Tool
{
    /**
     * @param  LinkedinService  $service  The LinkedIn API client
     */
    public function __construct(
        private LinkedinService $service,
    ) {}

    public function name(): string
    {
        return 'linkedin_create_post';
    }

    public function description(): string
    {
        return <<<'MD'
        Create a new LinkedIn UGC post.
        Requires an author URN and text content.
        Returns the created post with its ID and lifecycle state.
        MD;
    }

    public function parameters(): array
    {
        return [
            'author' => ['type' => 'string', 'required' => true, 'description' => 'Author URN (e.g. "urn:li:person:ABC123" or "urn:li:organization:12345").'],
            'text' => ['type' => 'string', 'required' => true, 'description' => 'Text content for the post.'],
            'visibility' => ['type' => 'string', 'description' => 'Visibility: "PUBLIC" (default) or "CONNECTIONS".'],
        ];
    }

    /**
     * Create a new LinkedIn UGC post.
     *
     * @param  array<string, mixed>  $args  Tool arguments (author, text, visibility)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('LinkedIn integration is not configured.');
            }

            $author = $args['author'] ?? '';
            if (empty($author)) {
                return ToolResult::error('author is required. Provide a LinkedIn URN (e.g. "urn:li:person:ABC123").');
            }

            $text = $args['text'] ?? '';
            if (empty($text)) {
                return ToolResult::error('text is required.');
            }

            $visibility = $args['visibility'] ?? 'PUBLIC';

            $payload = [
                'author' => $author,
                'lifecycleState' => 'PUBLISHED',
                'specificContent' => [
                    'com.linkedin.ugc.ShareContent' => [
                        'shareCommentary' => [
                            'text' => $text,
                        ],
                        'shareMediaCategory' => 'NONE',
                    ],
                ],
                'visibility' => [
                    'com.linkedin.ugc.MemberNetworkVisibility' => $visibility,
                ],
            ];

            $result = $this->service->createPost($payload);

            return ToolResult::success([
                'id' => $result['id'] ?? '',
                'lifecycle_state' => $result['lifecycleState'] ?? '',
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
