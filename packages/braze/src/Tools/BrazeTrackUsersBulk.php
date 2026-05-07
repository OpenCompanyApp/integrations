<?php

namespace OpenCompany\Integrations\Braze\Tools;

/**
 * Create or update users in bulk.
 */
class BrazeTrackUsersBulk extends AbstractBrazeTool
{
    protected array $parameters = array (
  'payload' =>
  array (
    'type' => 'object',
    'description' => 'Bulk users track payload.',
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

    protected string $path = '/users/track/bulk';

    protected string $toolName = 'braze_track_users_bulk';

    protected string $toolDescription = 'Create or update users in bulk.';
}