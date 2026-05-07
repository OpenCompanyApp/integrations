<?php

namespace OpenCompany\Integrations\Recruitee\Tools;

/**
 * Get the authenticated Recruitee user when available.
 */
class RecruiteeGetCurrentUser extends AbstractRecruiteeTool
{
    public const NAME = 'recruitee_get_current_user';
    public const DESCRIPTION = 'Get the currently authenticated Recruitee user when the host exposes /users/me.';
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
