<?php

namespace OpenCompany\Integrations\Close\Tools;

/**
 * List user availability statuses in Close.
 */
class CloseListUserAvailability extends AbstractCloseEndpointTool
{
    protected string $toolName = 'close_list_user_availability';

    protected string $toolDescription = 'List Close user availability statuses.';

    protected string $path = '/user/availability/';
}
