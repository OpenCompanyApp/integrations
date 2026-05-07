<?php

namespace OpenCompany\Integrations\Close\Tools;

/**
 * Delete a Close pipeline.
 */
class CloseDeletePipeline extends AbstractCloseEndpointTool
{
    protected string $toolName = 'close_delete_pipeline';

    protected string $toolDescription = 'Delete a Close pipeline.';

    protected string $method = 'DELETE';

    protected string $path = '/pipeline/{id}/';

    /** @var list<string> */
    protected array $required = ['id'];

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = [
        'id' => ['type' => 'string', 'required' => true, 'description' => 'Close pipeline ID to delete.'],
    ];
}
