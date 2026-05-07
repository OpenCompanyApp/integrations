<?php

namespace OpenCompany\Integrations\Canva\Tools;

/**
 * Fetches the current UserInfo claims for the authorized user.
 */
class CanvaGetOIDCUserInfo extends AbstractCanvaOperationTool
{
    protected const OPERATION = 'canva_get_oidc_user_info';
}
