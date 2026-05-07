<?php

namespace OpenCompany\Integrations\Close\Tools;

/**
 * List pipelines configured in Close.
 */
class CloseListPipelines extends AbstractCloseEndpointTool
{
    protected string $toolName = 'close_list_pipelines';

    protected string $toolDescription = 'List pipelines configured for the Close organization.';

    protected string $path = '/pipeline/';
}
