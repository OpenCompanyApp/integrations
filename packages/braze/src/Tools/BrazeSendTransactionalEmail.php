<?php

namespace OpenCompany\Integrations\Braze\Tools;

/**
 * Send a transactional email using API-triggered delivery.
 */
class BrazeSendTransactionalEmail extends AbstractBrazeTool
{
    protected array $parameters = array (
  'campaign_id' =>
  array (
    'type' => 'string',
    'description' => 'Transactional campaign ID.',
    'required' => true,
  ),
  'payload' =>
  array (
    'type' => 'object',
    'description' => 'Transactional send payload.',
  ),
);

    protected array $required = array (
  0 => 'campaign_id',
);

    protected array $queryParams = array (
);

    protected array $bodyParams = array (
  0 => 'payload',
);

    protected string $method = 'POST';

    protected string $path = '/transactional/v1/campaigns/{campaign_id}/send';

    protected string $toolName = 'braze_send_transactional_email';

    protected string $toolDescription = 'Send a transactional email using API-triggered delivery.';
}