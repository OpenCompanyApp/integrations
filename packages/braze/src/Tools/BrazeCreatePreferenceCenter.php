<?php

namespace OpenCompany\Integrations\Braze\Tools;

/**
 * Create a Braze preference center.
 */
class BrazeCreatePreferenceCenter extends AbstractBrazeTool
{
    protected array $parameters = array (
  'payload' =>
  array (
    'type' => 'object',
    'description' => 'Preference center payload.',
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

    protected string $path = '/preference_center/v1';

    protected string $toolName = 'braze_create_preference_center';

    protected string $toolDescription = 'Create a Braze preference center.';
}