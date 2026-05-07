<?php

namespace OpenCompany\Integrations\Braze\Tools;

/**
 * List custom events.
 */
class BrazeListEvents extends AbstractBrazeTool
{
    protected array $parameters = array (
  'page' =>
  array (
    'type' => 'integer',
    'description' => 'Page number.',
  ),
  'limit' =>
  array (
    'type' => 'integer',
    'description' => 'Results per page.',
  ),
);

    protected array $required = array (
);

    protected array $queryParams = array (
  0 => 'page',
  1 => 'limit',
);

    protected array $bodyParams = array (
);

    protected string $method = 'GET';

    protected string $path = '/events/list';

    protected string $toolName = 'braze_list_events';

    protected string $toolDescription = 'List custom events.';
}