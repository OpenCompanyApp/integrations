<?php

namespace OpenCompany\Integrations\Canva\Tools;

/**
 * Returns the User ID and Team ID of the user account associated with the provided access token.
 */
class CanvaGetCurrentUser extends AbstractCanvaOperationTool
{
    protected const OPERATION = 'canva_get_current_user';
}
