<?php

namespace OpenCompany\Integrations\Close\Tools;

/**
 * Create a Close note activity on a lead.
 */
class CloseCreateNote extends AbstractCloseEndpointTool
{
    protected string $toolName = 'close_create_note';

    protected string $toolDescription = 'Create a Close note activity on a lead.';

    protected string $method = 'POST';

    protected string $path = '/activity/note/';

    /** @var list<string> */
    protected array $required = ['lead_id', 'note'];

    /** @var list<string> */
    protected array $bodyParams = ['lead_id', 'contact_id', 'note', 'user_id'];

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = [
        'lead_id' => ['type' => 'string', 'required' => true, 'description' => 'Close lead ID that owns the note.'],
        'note' => ['type' => 'string', 'required' => true, 'description' => 'Note body.'],
        'contact_id' => ['type' => 'string', 'description' => 'Optional contact ID associated with the note.'],
        'user_id' => ['type' => 'string', 'description' => 'Optional Close user ID to attribute the note to.'],
    ];
}
