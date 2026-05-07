<?php

namespace OpenCompany\Integrations\Close\Tools;

/**
 * Update a Close note activity.
 */
class CloseUpdateNote extends AbstractCloseEndpointTool
{
    protected string $toolName = 'close_update_note';

    protected string $toolDescription = 'Update a Close note activity. Send the updated note body or association fields.';

    protected string $method = 'PUT';

    protected string $path = '/activity/note/{id}/';

    /** @var list<string> */
    protected array $required = ['id'];

    /** @var list<string> */
    protected array $bodyParams = ['lead_id', 'contact_id', 'note', 'user_id'];

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = [
        'id' => ['type' => 'string', 'required' => true, 'description' => 'Close note activity ID to update.'],
        'lead_id' => ['type' => 'string', 'description' => 'Associated Close lead ID.'],
        'contact_id' => ['type' => 'string', 'description' => 'Associated Close contact ID.'],
        'note' => ['type' => 'string', 'description' => 'Updated note body.'],
        'user_id' => ['type' => 'string', 'description' => 'Close user ID to attribute the note to.'],
    ];
}
