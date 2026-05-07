<?php

namespace OpenCompany\Integrations\Braze\Tools;

/**
 * Get a Braze preference center.
 */
class BrazeGetPreferenceCenter extends AbstractBrazeTool
{
    protected array $parameters = array (
  'preference_center_external_id' =>
  array (
    'type' => 'string',
    'description' => 'Preference center external ID.',
    'required' => true,
  ),
);

    protected array $required = array (
  0 => 'preference_center_external_id',
);

    protected array $queryParams = array (
);

    protected array $bodyParams = array (
);

    protected string $method = 'GET';

    protected string $path = '/preference_center/v1/{preference_center_external_id}';

    protected string $toolName = 'braze_get_preference_center';

    protected string $toolDescription = 'Get a Braze preference center.';
}