<?php

namespace OpenCompany\Integrations\Canva\Tools;

/**
 * Currently, this returns the display name of the user account associated with the provided access token.
 */
class CanvaGetUserProfile extends AbstractCanvaOperationTool
{
    protected const OPERATION = 'canva_get_user_profile';
}
