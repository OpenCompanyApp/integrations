<?php

namespace OpenCompany\Integrations\Droplr\Tools;

/**
 * Get the authenticated Droplr user profile.
 */
class DroplrGetCurrentUser extends AbstractDroplrTool
{
    public const NAME = 'droplr_get_current_user';
    public const DESCRIPTION = 'Get the authenticated Droplr user profile and account details.';
    public const PARAMETERS = [];

    /**
     * Get the current user.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     * @return array<string, mixed>
     */
    protected function call(array $args): array
    {
        return $this->service->getCurrentUser();
    }
}
