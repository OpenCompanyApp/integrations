<?php

namespace OpenCompany\Integrations\Braze\Tools;

/**
 * Update a Braze preference center.
 */
class BrazeUpdatePreferenceCenter extends AbstractBrazeTool
{
    protected array $parameters = array (
  'preference_center_external_id' =>
  array (
    'type' => 'string',
    'description' => 'Preference center external ID.',
    'required' => true,
  ),
  'payload' =>
  array (
    'type' => 'object',
    'description' => 'Preference center payload.',
  ),
);

    protected array $required = array (
  0 => 'preference_center_external_id',
);

    protected array $queryParams = array (
);

    protected array $bodyParams = array (
  0 => 'payload',
);

    protected string $method = 'PUT';

    protected string $path = '/preference_center/v1/{preference_center_external_id}';

    protected string $toolName = 'braze_update_preference_center';

    protected string $toolDescription = 'Update a Braze preference center.';
}