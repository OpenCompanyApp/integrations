<?php

namespace OpenCompany\Integrations\Braze\Tools;

/**
 * Merge Braze users.
 */
class BrazeMergeUsers extends AbstractBrazeTool
{
    protected array $parameters = array (
  'payload' =>
  array (
    'type' => 'object',
    'description' => 'User merge payload.',
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

    protected string $path = '/users/merge';

    protected string $toolName = 'braze_merge_users';

    protected string $toolDescription = 'Merge Braze users.';
}