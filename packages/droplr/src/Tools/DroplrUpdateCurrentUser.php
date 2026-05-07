<?php

namespace OpenCompany\Integrations\Droplr\Tools;

/**
 * Update authenticated Droplr account fields.
 */
class DroplrUpdateCurrentUser extends AbstractDroplrTool
{
    public const NAME = 'droplr_update_current_user';
    public const DESCRIPTION = 'Update Droplr account fields supported by the host API.';
    public const PARAMETERS = [
        'body' => ['type' => 'object', 'required' => true, 'description' => 'Account update payload.'],
    ];

    /**
     * Update current user/account fields.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     * @return array<string, mixed>
     */
    protected function call(array $args): array
    {
        return $this->service->updateCurrentUser($this->requiredArray($args, 'body', 'body'));
    }
}
