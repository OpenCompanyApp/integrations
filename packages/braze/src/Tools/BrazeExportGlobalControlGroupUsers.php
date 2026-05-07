<?php

namespace OpenCompany\Integrations\Braze\Tools;

/**
 * Export global control group users.
 */
class BrazeExportGlobalControlGroupUsers extends AbstractBrazeTool
{
    protected array $parameters = array (
  'payload' =>
  array (
    'type' => 'object',
    'description' => 'Global control group export payload.',
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

    protected string $path = '/users/export/global_control_group';

    protected string $toolName = 'braze_export_global_control_group_users';

    protected string $toolDescription = 'Export global control group users.';
}