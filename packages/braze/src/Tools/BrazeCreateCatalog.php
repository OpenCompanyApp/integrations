<?php

namespace OpenCompany\Integrations\Braze\Tools;

/**
 * Create a Braze catalog.
 */
class BrazeCreateCatalog extends AbstractBrazeTool
{
    protected array $parameters = array (
  'payload' =>
  array (
    'type' => 'object',
    'description' => 'Catalog creation payload.',
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

    protected string $path = '/catalogs';

    protected string $toolName = 'braze_create_catalog';

    protected string $toolDescription = 'Create a Braze catalog.';
}