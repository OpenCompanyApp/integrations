<?php

namespace OpenCompany\Integrations\Braze\Tools;

/**
 * List upcoming scheduled campaigns and Canvases.
 */
class BrazeListScheduledBroadcasts extends AbstractBrazeTool
{
    protected array $parameters = array (
  'end_time' =>
  array (
    'type' => 'string',
    'description' => 'Latest scheduled time to include.',
  ),
);

    protected array $required = array (
);

    protected array $queryParams = array (
  0 => 'end_time',
);

    protected array $bodyParams = array (
);

    protected string $method = 'GET';

    protected string $path = '/messages/scheduled_broadcasts';

    protected string $toolName = 'braze_list_scheduled_broadcasts';

    protected string $toolDescription = 'List upcoming scheduled campaigns and Canvases.';
}