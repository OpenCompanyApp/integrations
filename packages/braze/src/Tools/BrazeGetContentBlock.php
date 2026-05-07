<?php

namespace OpenCompany\Integrations\Braze\Tools;

/**
 * Get Content Block information.
 */
class BrazeGetContentBlock extends AbstractBrazeTool
{
    protected array $parameters = array (
  'content_block_id' =>
  array (
    'type' => 'string',
    'description' => 'Content Block ID.',
    'required' => true,
  ),
);

    protected array $required = array (
  0 => 'content_block_id',
);

    protected array $queryParams = array (
  0 => 'content_block_id',
);

    protected array $bodyParams = array (
);

    protected string $method = 'GET';

    protected string $path = '/content_blocks/info';

    protected string $toolName = 'braze_get_content_block';

    protected string $toolDescription = 'Get Content Block information.';
}