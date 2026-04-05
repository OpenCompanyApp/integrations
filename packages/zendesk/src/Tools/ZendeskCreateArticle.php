<?php

namespace OpenCompany\Integrations\Zendesk\Tools;

use OpenCompany\Integrations\Zendesk\ZendeskService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Create a Help Center article in a Zendesk section.
 */
class ZendeskCreateArticle implements Tool
{
    /**
     * @param  ZendeskService  $service  The Zendesk API client
     */
    public function __construct(
        private ZendeskService $service,
    ) {}

    public function name(): string
    {
        return 'zendesk_create_article';
    }

    public function description(): string
    {
        return 'Create a new Help Center article in a specified section. Requires section_id, title, and body.';
    }

    public function parameters(): array
    {
        return [
            'section_id' => ['type' => 'integer', 'required' => true, 'description' => 'The ID of the section to create the article in.'],
            'title' => ['type' => 'string', 'required' => true, 'description' => 'The title of the article.'],
            'body' => ['type' => 'string', 'required' => true, 'description' => 'The HTML body content of the article.'],
            'locale' => ['type' => 'string', 'description' => 'The locale of the article (e.g. "en-us"). Default: "en-us".'],
            'draft' => ['type' => 'boolean', 'description' => 'Whether the article should be created as a draft. Default: false.'],
            'labels' => ['type' => 'array', 'description' => 'Array of label strings. Example: ["faq", "billing"].'],
        ];
    }

    /**
     * Create a Help Center article with title, body, and optional fields.
     *
     * @param  array<string, mixed>  $args  Tool arguments (section_id, title, body, locale, draft, labels)
     */
    public function execute(array $args): ToolResult
    {
        if (! $this->service->isConfigured()) {
            return ToolResult::error('Zendesk is not configured. Missing email, API token, or subdomain.');
        }

        $sectionId = $args['section_id'] ?? '';
        $title = $args['title'] ?? '';
        $body = $args['body'] ?? '';

        if (empty($sectionId)) {
            return ToolResult::error('Section ID is required.');
        }

        if (empty($title)) {
            return ToolResult::error('Title is required.');
        }

        if (empty($body)) {
            return ToolResult::error('Body is required.');
        }

        try {
            $article = [
                'title' => $title,
                'body' => $body,
            ];

            if (isset($args['locale'])) {
                $article['locale'] = $args['locale'];
            }

            if (isset($args['draft'])) {
                $article['draft'] = (bool) $args['draft'];
            }

            if (isset($args['labels'])) {
                $article['label_names'] = $args['labels'];
            }

            $result = $this->service->createArticle((int) $sectionId, ['article' => $article]);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
