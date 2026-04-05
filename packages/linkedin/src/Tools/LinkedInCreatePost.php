<?php

namespace OpenCompany\Integrations\LinkedIn\Tools;

use OpenCompany\Integrations\LinkedIn\LinkedInService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool to create a post on behalf of the authenticated LinkedIn user.
 *
 * Accepts a text commentary and optional visibility setting, constructs
 * the proper UGC post payload following LinkedIn's UGC Posts API format,
 * and publishes the post.
 */
class LinkedInCreatePost implements Tool
{
    /**
     * Create a new LinkedInCreatePost tool instance.
     *
     * @param  LinkedInService  $service  The LinkedIn API service.
     */
    public function __construct(
        private LinkedInService $service,
    ) {}

    /**
     * Get the tool name identifier.
     */
    public function name(): string
    {
        return 'linkedin_create_post';
    }

    /**
     * Get the tool description for AI agent consumption.
     */
    public function description(): string
    {
        return 'Create and publish a post on LinkedIn on behalf of the authenticated user. Requires the post text content and optionally the author URN.';
    }

    /**
     * Get the tool parameter schema.
     *
     * @return array<string, array{type: string, required?: bool, description: string}>
     */
    public function parameters(): array
    {
        return [
            'text' => ['type' => 'string', 'required' => true, 'description' => 'The text content of the LinkedIn post.'],
            'author_urn' => ['type' => 'string', 'description' => 'The author URN (e.g., "urn:li:person:ABC123"). If omitted, the authenticated user is used.'],
            'visibility' => ['type' => 'string', 'description' => 'Post visibility: "PUBLIC" (anyone on LinkedIn) or "CONNECTIONS" (1st-degree connections only). Default: "PUBLIC".'],
        ];
    }

    /**
     * Execute the tool and create the LinkedIn post.
     *
     * @param  array<string, mixed>  $args  Tool arguments including 'text', optional 'author_urn', and 'visibility'.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('LinkedIn integration is not configured.');
            }

            $text = $args['text'] ?? '';
            if (empty(trim($text))) {
                return ToolResult::error('Post text content is required.');
            }

            $visibility = $args['visibility'] ?? 'PUBLIC';
            if (!in_array($visibility, ['PUBLIC', 'CONNECTIONS'], true)) {
                return ToolResult::error('Visibility must be either "PUBLIC" or "CONNECTIONS".');
            }

            // Build the author URN — use provided or construct from profile
            $authorUrn = $args['author_urn'] ?? null;
            if ($authorUrn === null) {
                $profile = $this->service->getProfile();
                $authorUrn = 'urn:li:person:' . ($profile['id'] ?? '');
            }

            $postBody = [
                'author' => $authorUrn,
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

            $result = $this->service->createPost($postBody);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
