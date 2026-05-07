<?php

namespace OpenCompany\Integrations\Front\Tools;

/**
 * Fetch the profile for the authenticated Front user.
 */
class FrontGetCurrentUser extends AbstractFrontTool
{
    protected const NAME = 'front_get_current_user';
    protected const DESCRIPTION = 'Get the profile of the currently authenticated Front user.';
    protected const METHOD = 'GET';
    protected const PATH = '/me';
    protected const PARAMETERS = [];
}
