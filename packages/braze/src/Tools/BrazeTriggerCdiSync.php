<?php

namespace OpenCompany\Integrations\Braze\Tools;

/**
 * Trigger a Cloud Data Ingestion sync.
 */
class BrazeTriggerCdiSync extends AbstractBrazeTool
{
    protected array $parameters = array (
  'integration_id' =>
  array (
    'type' => 'string',
    'description' => 'CDI integration ID.',
    'required' => true,
  ),
  'payload' =>
  array (
    'type' => 'object',
    'description' => 'Optional sync payload.',
  ),
);

    protected array $required = array (
  0 => 'integration_id',
);

    protected array $queryParams = array (
);

    protected array $bodyParams = array (
  0 => 'payload',
);

    protected string $method = 'POST';

    protected string $path = '/cdi/integrations/{integration_id}/sync';

    protected string $toolName = 'braze_trigger_cdi_sync';

    protected string $toolDescription = 'Trigger a Cloud Data Ingestion sync.';
}