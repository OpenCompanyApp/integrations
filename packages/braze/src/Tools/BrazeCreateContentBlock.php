<?php

namespace OpenCompany\Integrations\Braze\Tools;

/**
 * Create a Content Block.
 */
class BrazeCreateContentBlock extends AbstractBrazeTool
{
    protected array $parameters = array (
  'payload' =>
  array (
    'type' => 'object',
    'description' => 'Content Block payload.',
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

    protected string $path = '/content_blocks/create';

    protected string $toolName = 'braze_create_content_block';

    protected string $toolDescription = 'Create a Content Block.';
}