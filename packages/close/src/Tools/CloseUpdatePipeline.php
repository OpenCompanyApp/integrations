<?php

namespace OpenCompany\Integrations\Close\Tools;

/**
 * Update a Close pipeline.
 */
class CloseUpdatePipeline extends AbstractCloseEndpointTool
{
    protected string $toolName = 'close_update_pipeline';

    protected string $toolDescription = 'Update a Close pipeline name.';

    protected string $method = 'PUT';

    protected string $path = '/pipeline/{id}/';

    /** @var list<string> */
    protected array $required = ['id', 'name'];

    /** @var list<string> */
    protected array $bodyParams = ['name'];

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = [
        'id' => ['type' => 'string', 'required' => true, 'description' => 'Close pipeline ID.'],
        'name' => ['type' => 'string', 'required' => true, 'description' => 'Updated pipeline name.'],
    ];
}
