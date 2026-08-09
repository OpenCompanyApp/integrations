<?php

namespace OpenCompany\Integrations\Canny;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;

/**
 * Tool catalog and configuration metadata for Canny.
 *
 * Exposes Canny's documented API operations across feedback boards, posts,
 * comments, votes, users, companies, insights, changelog entries, and Autopilot.
 */
class CannyToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
{
    private const TOOL_DEFINITIONS = [
        'canny_retrieve_board' => ['CannyRetrieveBoard', 'read', 'Retrieve Board', 'Retrieve a Canny board by ID.', 'ph:columns'],
        'canny_list_boards' => ['CannyListBoards', 'read', 'List Boards', 'List all Canny boards.', 'ph:columns'],
        'canny_retrieve_category' => ['CannyRetrieveCategory', 'read', 'Retrieve Category', 'Retrieve a category by ID.', 'ph:folder'],
        'canny_list_categories' => ['CannyListCategories', 'read', 'List Categories', 'List categories with optional board and pagination filters.', 'ph:folders'],
        'canny_create_category' => ['CannyCreateCategory', 'write', 'Create Category', 'Create a category for a board.', 'ph:folder-plus'],
        'canny_delete_category' => ['CannyDeleteCategory', 'write', 'Delete Category', 'Delete a category.', 'ph:folder-minus'],
        'canny_create_entry' => ['CannyCreateEntry', 'write', 'Create Changelog Entry', 'Create a changelog entry.', 'ph:newspaper'],
        'canny_list_entries' => ['CannyListEntries', 'read', 'List Changelog Entries', 'List changelog entries.', 'ph:newspaper'],
        'canny_retrieve_comment' => ['CannyRetrieveComment', 'read', 'Retrieve Comment', 'Retrieve a comment by ID.', 'ph:chat-text'],
        'canny_list_comments' => ['CannyListComments', 'read', 'List Comments', 'List comments with cursor pagination.', 'ph:chats'],
        'canny_create_comment' => ['CannyCreateComment', 'write', 'Create Comment', 'Create a comment on a post.', 'ph:chat-circle-text'],
        'canny_delete_comment' => ['CannyDeleteComment', 'write', 'Delete Comment', 'Delete a comment.', 'ph:chat-circle-dots'],
        'canny_list_companies' => ['CannyListCompanies', 'read', 'List Companies', 'List companies with cursor pagination.', 'ph:buildings'],
        'canny_update_company' => ['CannyUpdateCompany', 'write', 'Update Company', 'Update a company.', 'ph:building-office'],
        'canny_delete_company' => ['CannyDeleteCompany', 'write', 'Delete Company', 'Delete a company.', 'ph:building'],
        'canny_list_groups' => ['CannyListGroups', 'read', 'List Groups', 'List groups.', 'ph:users-three'],
        'canny_retrieve_group' => ['CannyRetrieveGroup', 'read', 'Retrieve Group', 'Retrieve a group.', 'ph:users'],
        'canny_list_ideas' => ['CannyListIdeas', 'read', 'List Ideas', 'List Canny ideas.', 'ph:lightbulb'],
        'canny_merge_idea' => ['CannyMergeIdea', 'write', 'Merge Idea', 'Merge one idea into another.', 'ph:git-merge'],
        'canny_retrieve_idea' => ['CannyRetrieveIdea', 'read', 'Retrieve Idea', 'Retrieve an idea.', 'ph:lightbulb-filament'],
        'canny_delete_idea' => ['CannyDeleteIdea', 'write', 'Delete Idea', 'Delete an idea.', 'ph:trash'],
        'canny_list_insights' => ['CannyListInsights', 'read', 'List Insights', 'List Canny insights.', 'ph:chart-line'],
        'canny_retrieve_insight' => ['CannyRetrieveInsight', 'read', 'Retrieve Insight', 'Retrieve an insight.', 'ph:chart-pie'],
        'canny_list_opportunities' => ['CannyListOpportunities', 'read', 'List Opportunities', 'List opportunities.', 'ph:target'],
        'canny_retrieve_post' => ['CannyRetrievePost', 'read', 'Retrieve Post', 'Retrieve a feedback post.', 'ph:note'],
        'canny_list_posts' => ['CannyListPosts', 'read', 'List Posts', 'List feedback posts with filters.', 'ph:list-bullets'],
        'canny_create_post' => ['CannyCreatePost', 'write', 'Create Post', 'Create a feedback post.', 'ph:note-pencil'],
        'canny_change_post_board' => ['CannyChangePostBoard', 'write', 'Change Post Board', 'Move a post to another board.', 'ph:arrows-left-right'],
        'canny_change_post_category' => ['CannyChangePostCategory', 'write', 'Change Post Category', 'Assign or clear a post category.', 'ph:folder-simple'],
        'canny_change_post_status' => ['CannyChangePostStatus', 'write', 'Change Post Status', 'Change a post status.', 'ph:flag'],
        'canny_merge_post' => ['CannyMergePost', 'write', 'Merge Post', 'Merge one post into another.', 'ph:git-merge'],
        'canny_add_post_tag' => ['CannyAddPostTag', 'write', 'Add Post Tag', 'Add a tag to a post.', 'ph:tag'],
        'canny_remove_post_tag' => ['CannyRemovePostTag', 'write', 'Remove Post Tag', 'Remove a tag from a post.', 'ph:tag-chevron'],
        'canny_update_post' => ['CannyUpdatePost', 'write', 'Update Post', 'Update post fields.', 'ph:pencil'],
        'canny_delete_post' => ['CannyDeletePost', 'write', 'Delete Post', 'Delete a post.', 'ph:trash'],
        'canny_link_jira_issue' => ['CannyLinkJiraIssue', 'write', 'Link Jira Issue', 'Link a Jira issue to a post.', 'ph:link'],
        'canny_unlink_jira_issue' => ['CannyUnlinkJiraIssue', 'write', 'Unlink Jira Issue', 'Unlink a Jira issue from a post.', 'ph:link-break'],
        'canny_list_status_changes' => ['CannyListStatusChanges', 'read', 'List Status Changes', 'List post status changes.', 'ph:clock-counter-clockwise'],
        'canny_retrieve_tag' => ['CannyRetrieveTag', 'read', 'Retrieve Tag', 'Retrieve a tag.', 'ph:tag'],
        'canny_list_tags' => ['CannyListTags', 'read', 'List Tags', 'List tags.', 'ph:tags'],
        'canny_create_tag' => ['CannyCreateTag', 'write', 'Create Tag', 'Create a tag.', 'ph:tag-simple'],
        'canny_list_users' => ['CannyListUsers', 'read', 'List Users', 'List users with cursor pagination.', 'ph:user-list'],
        'canny_retrieve_user' => ['CannyRetrieveUser', 'read', 'Retrieve User', 'Retrieve a user.', 'ph:user'],
        'canny_create_or_update_user' => ['CannyCreateOrUpdateUser', 'write', 'Create Or Update User', 'Create or update a user.', 'ph:user-plus'],
        'canny_find_or_create_user' => ['CannyFindOrCreateUser', 'write', 'Find Or Create User', 'Deprecated Canny user upsert endpoint.', 'ph:user-circle-plus'],
        'canny_delete_user' => ['CannyDeleteUser', 'write', 'Delete User', 'Delete a user.', 'ph:user-minus'],
        'canny_remove_user_from_company' => ['CannyRemoveUserFromCompany', 'write', 'Remove User From Company', 'Remove a user from a company.', 'ph:user-switch'],
        'canny_retrieve_vote' => ['CannyRetrieveVote', 'read', 'Retrieve Vote', 'Retrieve a vote.', 'ph:thumbs-up'],
        'canny_list_votes' => ['CannyListVotes', 'read', 'List Votes', 'List votes with cursor pagination.', 'ph:list-checks'],
        'canny_create_vote' => ['CannyCreateVote', 'write', 'Create Vote', 'Create a vote.', 'ph:thumbs-up'],
        'canny_delete_vote' => ['CannyDeleteVote', 'write', 'Delete Vote', 'Delete a vote.', 'ph:thumbs-down'],
        'canny_enqueue_feedback' => ['CannyEnqueueFeedback', 'write', 'Enqueue Feedback', 'Send feedback to Canny Autopilot.', 'ph:sparkle'],
        'canny_api_post' => ['CannyApiPost', 'write', 'API POST', 'Call a safe relative Canny API path.', 'ph:code'],
    ];

    /**
     * Describe authentication and host capabilities.
     *
     * @return array<string, mixed>
     */
    public function integrationCapabilities(): array
    {
        return [
            'auth' => [
                'strategy' => 'api_key',
                'legacy_auth_type' => 'api_key',
                'credential_mode' => 'required_secret',
                'setup_flows' => ['manual_secret'],
                'requires_browser_for_setup' => false,
                'refreshable' => false,
                'token_keys' => ['api_key'],
                'notes' => ['Canny expects the secret API key in the JSON body as apiKey.'],
            ],
            'host_availability' => [
                'web' => ['setup_supported' => true, 'runtime_supported' => true, 'setup_mode' => 'manual_secret'],
                'cli' => ['setup_supported' => true, 'runtime_supported' => true, 'setup_mode' => 'manual_secret', 'runtime_mode' => 'normal'],
            ],
            'runtime_requirements' => [],
            'compatibility' => ['web_setup_supported' => true, 'web_runtime_supported' => true, 'cli_setup_supported' => true, 'cli_runtime_supported' => true],
        ];
    }

    public function appName(): string { return 'canny'; }

    public function appMeta(): array
    {
        return ['label' => 'Canny', 'description' => 'Product feedback, posts, votes, users, and changelog', 'icon' => 'ph:megaphone', 'logo' => 'simple-icons:canny'];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Canny',
            'description' => 'Manage product feedback boards, posts, comments, votes, users, companies, insights, changelog entries, and Autopilot feedback.',
            'icon' => 'ph:megaphone',
            'logo' => 'simple-icons:canny',
            'category' => 'productivity',
            'badge' => 'verified',
            'docs_url' => 'https://developers.canny.io/api-reference',
        ];
    }

    public function configSchema(): array { return $this->credentialFields(); }

    /**
     * Verify Canny credentials with the list boards endpoint.
     *
     * @param  array<string, mixed>  $config  Credential settings.
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(array $config): array
    {
        try {
            $apiKey = (string) ($config['api_key'] ?? '');
            if ($apiKey === '') {
                return ['success' => false, 'error' => 'Canny API key is required.'];
            }

            $baseUrl = rtrim((string) ($config['url'] ?? ''), '/') ?: 'https://canny.io';
            $response = Http::withHeaders(['Accept' => 'application/json', 'Content-Type' => 'application/json'])
                ->timeout(20)
                ->post($baseUrl.'/api/v1/boards/list', ['apiKey' => $apiKey]);

            if (!$response->successful()) {
                return ['success' => false, 'error' => 'Canny API returned HTTP '.$response->status().'.'];
            }

            return ['success' => true, 'message' => 'Connected to Canny API.'];
        } catch (\Throwable $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    public function validationRules(): array
    {
        return ['api_key' => 'required|string', 'url' => 'nullable|string'];
    }

    public function credentialFields(): array
    {
        return [
            ['key' => 'api_key', 'type' => 'secret', 'label' => 'API Key', 'placeholder' => 'Canny secret API key', 'hint' => 'Canny secret API key from company settings.', 'required' => true],
            ['key' => 'url', 'type' => 'text', 'label' => 'API URL', 'placeholder' => 'https://canny.io', 'hint' => 'Optional Canny base URL override.', 'required' => false],
        ];
    }

    public function tools(): array
    {
        $tools = [];
        foreach (self::TOOL_DEFINITIONS as $slug => [$class, $type, $name, $description, $icon]) {
            $tools[$slug] = ['class' => __NAMESPACE__.'\\Tools\\'.$class, 'type' => $type, 'name' => $name, 'description' => $description, 'icon' => $icon];
        }

        return $tools;
    }

    public function isIntegration(): bool { return true; }

    /**
     * Create a Canny tool instance.
     *
     * @param  array<string, mixed>  $context  Optional account context.
     */
    public function createTool(string $class, array $context = []): Tool
    {
        return new $class($this->resolveService($context));
    }

    /**
     * Resolve a service for the default or named account.
     *
     * @param  array<string, mixed>  $context  Tool creation context.
     */
    private function resolveService(array $context = []): CannyService
    {
        $account = $context['account'] ?? null;
        if ($account !== null) {
            $creds = app(CredentialResolver::class);

            return new CannyService(
                apiKey: $creds->get('canny', 'api_key', '', $account),
                baseUrl: $creds->get('canny', 'url', 'https://canny.io', $account),
            );
        }

        return app(CannyService::class);
    }

    public function scriptDocsPath(): ?string
    {
        return __DIR__.'/../script-docs/canny.md';
    }
}
