<?php

namespace OpenCompany\Integrations\OpenAlex\Tools;

use InvalidArgumentException;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\OpenAlex\OpenAlexService;

/**
 * Search OpenAlex autocomplete/typeahead suggestions.
 *
 * Supports the entity types OpenAlex exposes for autocomplete.
 */
class OpenAlexAutocomplete implements Tool
{
    /**
     * @param  OpenAlexService  $service  OpenAlex API client.
     */
    public function __construct(private OpenAlexService $service) {}

    public function name(): string
    {
        return 'openalex_autocomplete';
    }

    public function description(): string
    {
        return 'Search OpenAlex autocomplete suggestions for works, authors, sources, institutions, topics, keywords, publishers, or funders.';
    }

    public function parameters(): array
    {
        return [
            'entity' => ['type' => 'string', 'required' => true, 'description' => 'Autocomplete entity type.', 'enum' => OpenAlexService::AUTOCOMPLETE_ENTITIES],
            'q' => ['type' => 'string', 'required' => true, 'description' => 'Search query string.'],
            'filter' => ['type' => ['string', 'object'], 'required' => false, 'description' => 'Optional OpenAlex filter.'],
            'query' => ['type' => 'object', 'required' => false, 'description' => 'Additional official autocomplete query parameters.'],
        ];
    }

    /**
     * Execute OpenAlex autocomplete.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            $entity = (string) ($args['entity'] ?? '');
            $q = (string) ($args['q'] ?? '');
            if ($entity === '') {
                throw new InvalidArgumentException('entity is required.');
            }
            if ($q === '') {
                throw new InvalidArgumentException('q is required.');
            }

            $query = isset($args['query']) && is_array($args['query']) ? $args['query'] : [];
            unset($args['query'], $args['entity']);

            return ToolResult::success($this->service->autocomplete($entity, array_merge($query, $args)));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
