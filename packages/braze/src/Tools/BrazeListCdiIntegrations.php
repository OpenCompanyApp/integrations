<?php

namespace OpenCompany\Integrations\Braze\Tools;

/**
 * List Braze Cloud Data Ingestion integrations.
 */
class BrazeListCdiIntegrations extends AbstractBrazeTool
{
    protected array $parameters = array (
);

    protected array $required = array (
);

    protected array $queryParams = array (
);

    protected array $bodyParams = array (
);

    protected string $method = 'GET';

    protected string $path = '/cdi/integrations';

    protected string $toolName = 'braze_list_cdi_integrations';

    protected string $toolDescription = 'List Braze Cloud Data Ingestion integrations.';
}