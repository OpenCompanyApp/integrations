<?php

namespace OpenCompany\Integrations\Braze\Tools;

/**
 * Export user profiles by identifiers.
 */
class BrazeExportUsersByIds extends AbstractBrazeTool
{
    protected array $parameters = array (
  'payload' =>
  array (
    'type' => 'object',
    'description' => 'User export identifier payload.',
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

    protected string $path = '/users/export/ids';

    protected string $toolName = 'braze_export_users_by_ids';

    protected string $toolDescription = 'Export user profiles by identifiers.';
}