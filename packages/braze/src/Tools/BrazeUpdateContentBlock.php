<?php

namespace OpenCompany\Integrations\Braze\Tools;

/**
 * Update a Content Block.
 */
class BrazeUpdateContentBlock extends AbstractBrazeTool
{
    protected array $parameters = array (
  'payload' =>
  array (
    'type' => 'object',
    'description' => 'Content Block update payload.',
  ),
);

    protected array $required = array (
);

    protected array $queryParams = array (
);

    protected array $bodyParams = array (
  0 => 'payload',
);

    protected string $method = 'POST';

    protected string $path = '/content_blocks_update';

    protected string $toolName = 'braze_update_content_block';

    protected string $toolDescription = 'Update a Content Block.';
}