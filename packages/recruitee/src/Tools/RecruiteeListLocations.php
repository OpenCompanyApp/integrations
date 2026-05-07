<?php

namespace OpenCompany\Integrations\Recruitee\Tools;

/**
 * List company locations from Recruitee.
 */
class RecruiteeListLocations extends AbstractRecruiteeTool
{
    public const NAME = 'recruitee_list_locations';
    public const DESCRIPTION = 'List Recruitee company locations with optional scope, search, and view mode parameters.';
    public const PARAMETERS = [
        'limit' => ['type' => 'integer', 'description' => 'Maximum number of locations.'],
        'page' => ['type' => 'integer', 'description' => 'Page number.'],
        'query' => ['type' => 'string', 'description' => 'Search term.'],
        'scope' => ['type' => 'string', 'enum' => ['active', 'archived', 'all'], 'description' => 'Location scope.'],
        'view_mode' => ['type' => 'string', 'enum' => ['brief', 'full'], 'description' => 'Brief or full location representation.'],
    ];

    /**
     * List locations.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     * @return array<string, mixed>
     */
    protected function call(array $args): array
    {
        return $this->service->listLocations(array_filter([
            'limit' => isset($args['limit']) ? (int) $args['limit'] : null,
            'page' => isset($args['page']) ? (int) $args['page'] : null,
            'query' => $args['query'] ?? null,
            'scope' => $args['scope'] ?? null,
            'view_mode' => $args['view_mode'] ?? null,
        ], static fn ($value): bool => $value !== null && $value !== ''));
    }
}
