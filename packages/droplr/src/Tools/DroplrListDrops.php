<?php

namespace OpenCompany\Integrations\Droplr\Tools;

/**
 * List drops from Droplr.
 */
class DroplrListDrops extends AbstractDroplrTool
{
    public const NAME = 'droplr_list_drops';
    public const DESCRIPTION = 'List Droplr drops with pagination, type, search, sort, and timestamp filters.';
    public const PARAMETERS = [
        'page' => ['type' => 'integer', 'description' => 'Page number for the bearer API.'],
        'limit' => ['type' => 'integer', 'description' => 'Number of results per page.'],
        'offset' => ['type' => 'integer', 'description' => 'Legacy documented offset parameter.'],
        'amount' => ['type' => 'integer', 'description' => 'Legacy documented amount parameter.'],
        'type' => ['type' => 'string', 'enum' => ['LINK', 'NOTE', 'IMAGE', 'AUDIO', 'VIDEO', 'FILE'], 'description' => 'Drop type filter.'],
        'q' => ['type' => 'string', 'description' => 'Search query.'],
        'sortBy' => ['type' => 'string', 'enum' => ['CREATION', 'CODE', 'TITLE', 'SIZE', 'ACTIVITY', 'VIEWS'], 'description' => 'Sort field.'],
        'order' => ['type' => 'string', 'enum' => ['ASC', 'DESC'], 'description' => 'Sort order.'],
        'since' => ['type' => 'integer', 'description' => 'Created after timestamp in milliseconds.'],
        'until' => ['type' => 'integer', 'description' => 'Created before timestamp in milliseconds.'],
    ];

    /**
     * List drops.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     * @return array<string, mixed>
     */
    protected function call(array $args): array
    {
        return $this->service->listDrops(array_filter([
            'page' => isset($args['page']) ? (int) $args['page'] : null,
            'limit' => isset($args['limit']) ? (int) $args['limit'] : null,
            'offset' => isset($args['offset']) ? (int) $args['offset'] : null,
            'amount' => isset($args['amount']) ? (int) $args['amount'] : null,
            'type' => $args['type'] ?? null,
            'q' => $args['q'] ?? null,
            'sortBy' => $args['sortBy'] ?? null,
            'order' => $args['order'] ?? null,
            'since' => isset($args['since']) ? (int) $args['since'] : null,
            'until' => isset($args['until']) ? (int) $args['until'] : null,
        ], static fn ($value): bool => $value !== null && $value !== ''));
    }
}
