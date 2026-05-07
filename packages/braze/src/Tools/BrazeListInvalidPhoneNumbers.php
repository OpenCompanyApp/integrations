<?php

namespace OpenCompany\Integrations\Braze\Tools;

/**
 * Query invalid phone numbers.
 */
class BrazeListInvalidPhoneNumbers extends AbstractBrazeTool
{
    protected array $parameters = array (
  'start_date' =>
  array (
    'type' => 'string',
    'description' => 'Start date.',
  ),
  'end_date' =>
  array (
    'type' => 'string',
    'description' => 'End date.',
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
  0 => 'start_date',
  1 => 'end_date',
  2 => 'limit',
  3 => 'offset',
);

    protected array $bodyParams = array (
);

    protected string $method = 'GET';

    protected string $path = '/sms/invalid_phone_numbers';

    protected string $toolName = 'braze_list_invalid_phone_numbers';

    protected string $toolDescription = 'Query invalid phone numbers.';
}