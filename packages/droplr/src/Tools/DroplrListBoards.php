<?php

namespace OpenCompany\Integrations\Droplr\Tools;

/**
 * List Droplr boards.
 */
class DroplrListBoards extends AbstractDroplrTool
{
    public const NAME = 'droplr_list_boards';
    public const DESCRIPTION = 'List Droplr boards with optional pagination.';
    public const PARAMETERS = [
        'page' => ['type' => 'integer', 'description' => 'Page number.'],
        'limit' => ['type' => 'integer', 'description' => 'Number of results per page.'],
    ];

    /**
     * List boards.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     * @return array<string, mixed>
     */
    protected function call(array $args): array
    {
        return $this->service->listBoards(array_filter([
            'page' => isset($args['page']) ? (int) $args['page'] : null,
            'limit' => isset($args['limit']) ? (int) $args['limit'] : null,
        ], static fn ($value): bool => $value !== null));
    }
}
