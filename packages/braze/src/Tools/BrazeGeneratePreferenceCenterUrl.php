<?php

namespace OpenCompany\Integrations\Braze\Tools;

/**
 * Generate a preference center URL for a user.
 */
class BrazeGeneratePreferenceCenterUrl extends AbstractBrazeTool
{
    protected array $parameters = array (
  'preference_center_external_id' =>
  array (
    'type' => 'string',
    'description' => 'Preference center external ID.',
    'required' => true,
  ),
  'user_id' =>
  array (
    'type' => 'string',
    'description' => 'External user ID.',
    'required' => true,
  ),
);

    protected array $required = array (
  0 => 'preference_center_external_id',
  1 => 'user_id',
);

    protected array $queryParams = array (
);

    protected array $bodyParams = array (
);

    protected string $method = 'GET';

    protected string $path = '/preference_center/v1/{preference_center_external_id}/url/{user_id}';

    protected string $toolName = 'braze_generate_preference_center_url';

    protected string $toolDescription = 'Generate a preference center URL for a user.';
}