<?php

namespace OpenCompany\Integrations\Braze\Tools;

/**
 * Create send IDs for message blast tracking.
 */
class BrazeCreateSendIds extends AbstractBrazeTool
{
    protected array $parameters = array (
  'payload' =>
  array (
    'type' => 'object',
    'description' => 'Send ID creation payload.',
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

    protected string $path = '/sends/id/create';

    protected string $toolName = 'braze_create_send_ids';

    protected string $toolDescription = 'Create send IDs for message blast tracking.';
}