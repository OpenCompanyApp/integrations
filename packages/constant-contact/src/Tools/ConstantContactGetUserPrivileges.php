<?php

namespace OpenCompany\Integrations\ConstantContact\Tools;

/**
 * Get Constant Contact user privileges for the access token.
 */
class ConstantContactGetUserPrivileges extends AbstractConstantContactTool
{
    public function name(): string
    {
        return 'constantcontact_get_user_privileges';
    }

    public function description(): string
    {
        return 'Get Constant Contact user privileges for the current access token.';
    }

    public function parameters(): array
    {
        return [];
    }

    protected function callService(array $args): array
    {
        return $this->service->getUserPrivileges();
    }
}
