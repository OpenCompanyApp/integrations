<?php

namespace OpenCompany\Integrations\Braze\Tools;

/**
 * Export user profiles by segment.
 */
class BrazeExportUsersBySegment extends AbstractBrazeTool
{
    protected array $parameters = array (
  'payload' =>
  array (
    'type' => 'object',
    'description' => 'Segment export payload.',
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

    protected string $path = '/users/export/segment';

    protected string $toolName = 'braze_export_users_by_segment';

    protected string $toolDescription = 'Export user profiles by segment.';
}