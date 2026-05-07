<?php

namespace OpenCompany\Integrations\Braze\Tools;

/**
 * Get Cloud Data Ingestion sync status.
 */
class BrazeGetCdiSyncStatus extends AbstractBrazeTool
{
    protected array $parameters = array (
  'integration_id' =>
  array (
    'type' => 'string',
    'description' => 'CDI integration ID.',
    'required' => true,
  ),
);

    protected array $required = array (
  0 => 'integration_id',
);

    protected array $queryParams = array (
);

    protected array $bodyParams = array (
);

    protected string $method = 'GET';

    protected string $path = '/cdi/integrations/{integration_id}/sync/status';

    protected string $toolName = 'braze_get_cdi_sync_status';

    protected string $toolDescription = 'Get Cloud Data Ingestion sync status.';
}