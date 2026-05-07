<?php

namespace OpenCompany\Integrations\Brandfetch\Tools;

/**
 * Verify Brand API credentials with the free Brandfetch test brand.
 */
class BrandfetchGetCurrentUser extends AbstractBrandfetchTool
{
    protected const TOOL_NAME = 'brandfetch_get_current_user';
    protected const TOOL_DESCRIPTION = 'Verify Brandfetch Brand API credentials by fetching the Brandfetch test brand.';
    protected const PARAMETERS = [];

    protected function run(array $args): array
    {
        return $this->service->getCurrentUser();
    }
}
