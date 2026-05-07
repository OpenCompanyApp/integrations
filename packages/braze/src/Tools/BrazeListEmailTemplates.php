<?php

namespace OpenCompany\Integrations\Braze\Tools;

/**
 * List email templates.
 */
class BrazeListEmailTemplates extends AbstractBrazeTool
{
    protected array $parameters = array (
  'modified_after' =>
  array (
    'type' => 'string',
    'description' => 'Filter by modification date.',
  ),
  'modified_before' =>
  array (
    'type' => 'string',
    'description' => 'Filter by modification date.',
  ),
  'limit' =>
  array (
    'type' => 'integer',
    'description' => 'Maximum records.',
  ),
  'offset' =>
  array (
    'type' => 'integer',
    'description' => 'Pagination offset.',
  ),
);

    protected array $required = array (
);

    protected array $queryParams = array (
  0 => 'modified_after',
  1 => 'modified_before',
  2 => 'limit',
  3 => 'offset',
);

    protected array $bodyParams = array (
);

    protected string $method = 'GET';

    protected string $path = '/templates/email/list';

    protected string $toolName = 'braze_list_email_templates';

    protected string $toolDescription = 'List email templates.';
}