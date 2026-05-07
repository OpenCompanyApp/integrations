<?php

namespace OpenCompany\Integrations\Braze\Tools;

/**
 * List Braze preference centers.
 */
class BrazeListPreferenceCenters extends AbstractBrazeTool
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

    protected string $path = '/preference_center/v1/list';

    protected string $toolName = 'braze_list_preference_centers';

    protected string $toolDescription = 'List Braze preference centers.';
}