<?php

namespace OpenCompany\Integrations\Braze\Tools;

/**
 * Create or update users, custom events, and purchases.
 */
class BrazeTrackUsers extends AbstractBrazeTool
{
    protected array $parameters = array (
  'payload' =>
  array (
    'type' => 'object',
    'description' => 'Users track payload.',
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

    protected string $path = '/users/track';

    protected string $toolName = 'braze_track_users';

    protected string $toolDescription = 'Create or update users, custom events, and purchases.';
}