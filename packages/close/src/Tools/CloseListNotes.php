<?php

namespace OpenCompany\Integrations\Close\Tools;

/**
 * List Close note activities.
 */
class CloseListNotes extends AbstractCloseEndpointTool
{
    protected string $toolName = 'close_list_notes';

    protected string $toolDescription = 'List or filter Close note activities by lead, user, date, and pagination fields.';

    protected string $path = '/activity/note/';

    /** @var list<string> */
    protected array $queryParams = ['lead_id', 'user_id', 'date_created__gt', 'date_created__gte', 'date_created__lt', 'date_created__lte', '_limit', '_skip'];

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = [
        'lead_id' => ['type' => 'string', 'description' => 'Filter notes by Close lead ID.'],
        'user_id' => ['type' => 'string', 'description' => 'Filter notes by author user ID.'],
        'date_created__gt' => ['type' => 'string', 'description' => 'Filter notes created after this timestamp.'],
        'date_created__gte' => ['type' => 'string', 'description' => 'Filter notes created on or after this timestamp.'],
        'date_created__lt' => ['type' => 'string', 'description' => 'Filter notes created before this timestamp.'],
        'date_created__lte' => ['type' => 'string', 'description' => 'Filter notes created on or before this timestamp.'],
        '_limit' => ['type' => 'integer', 'description' => 'Maximum number of notes to return.'],
        '_skip' => ['type' => 'integer', 'description' => 'Number of records to skip.'],
    ];
}
