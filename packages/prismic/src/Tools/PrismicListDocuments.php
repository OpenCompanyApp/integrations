<?php

namespace OpenCompany\Integrations\Prismic\Tools;

use OpenCompany\Integrations\Prismic\PrismicService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class PrismicListDocuments implements Tool
{
    /**
     * Create a new PrismicListDocuments tool instance.
     */
    public function __construct(
        private PrismicService $service,
    ) {}

    /**
     * Get the tool name.
     */
    public function name(): string
    {
        return 'prismic_list_documents';
    }

    /**
     * Get the tool description.
     */
    public function description(): string
    {
        return 'Search and list documents from the Prismic repository. Supports filtering with Prismic query predicates, pagination, ordering, and language selection.';
    }

    /**
     * Get the tool parameters schema.
     */
    public function parameters(): array
    {
        return [
            'q' => ['type' => 'string', 'description' => 'Prismic query predicate(s), e.g. \'[[:d = at(document.type, "blog_post")]]\'. Multiple predicates can be combined.'],
            'pageSize' => ['type' => 'integer', 'description' => 'Number of documents per page (default: 20, max: 100).'],
            'page' => ['type' => 'integer', 'description' => 'Page number for pagination (default: 1).'],
            'orderings' => ['type' => 'string', 'description' => 'Ordering rules, e.g. "[my.blog_post.date desc]".'],
            'lang' => ['type' => 'string', 'description' => 'Language code to filter results (e.g., "en-us", "fr-fr"). Use "*" for all languages.'],
            'ref' => ['type' => 'string', 'description' => 'The ref (release/draft) ID to query. Defaults to the master ref.'],
        ];
    }

    /**
     * Execute the tool and return the result.
     *
     * @param  array  $args  The tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Prismic integration is not configured.');
            }

            $params = [];

            if (isset($args['q'])) {
                $params['q'] = $args['q'];
            }
            if (isset($args['pageSize'])) {
                $params['pageSize'] = (int) $args['pageSize'];
            }
            if (isset($args['page'])) {
                $params['page'] = (int) $args['page'];
            }
            if (isset($args['orderings'])) {
                $params['orderings'] = $args['orderings'];
            }
            if (isset($args['lang'])) {
                $params['lang'] = $args['lang'];
            }
            if (isset($args['ref'])) {
                $params['ref'] = $args['ref'];
            }

            $result = $this->service->searchDocuments($params);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
