<?php

namespace OpenCompany\Integrations\Braze\Tools;

/**
 * Duplicate a Braze Canvas.
 */
class BrazeDuplicateCanvas extends AbstractBrazeTool
{
    protected array $parameters = array (
  'payload' =>
  array (
    'type' => 'object',
    'description' => 'Canvas duplicate payload.',
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

    protected string $path = '/canvas/duplicate';

    protected string $toolName = 'braze_duplicate_canvas';

    protected string $toolDescription = 'Duplicate a Braze Canvas.';
}