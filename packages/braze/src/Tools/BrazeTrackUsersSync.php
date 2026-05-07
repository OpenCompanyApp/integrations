<?php

namespace OpenCompany\Integrations\Braze\Tools;

/**
 * Synchronously create or update users.
 */
class BrazeTrackUsersSync extends AbstractBrazeTool
{
    protected array $parameters = array (
  'payload' =>
  array (
    'type' => 'object',
    'description' => 'Synchronous users track payload.',
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

    protected string $path = '/users/track/sync';

    protected string $toolName = 'braze_track_users_sync';

    protected string $toolDescription = 'Synchronously create or update users.';
}