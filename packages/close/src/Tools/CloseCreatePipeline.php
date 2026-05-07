<?php

namespace OpenCompany\Integrations\Close\Tools;

/**
 * Create a Close pipeline.
 */
class CloseCreatePipeline extends AbstractCloseEndpointTool
{
    protected string $toolName = 'close_create_pipeline';

    protected string $toolDescription = 'Create a Close sales pipeline.';

    protected string $method = 'POST';

    protected string $path = '/pipeline/';

    /** @var list<string> */
    protected array $required = ['name'];

    /** @var list<string> */
    protected array $bodyParams = ['name'];

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = [
        'name' => ['type' => 'string', 'required' => true, 'description' => 'Pipeline name.'],
    ];
}
