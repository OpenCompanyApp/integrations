<?php

namespace OpenCompany\Integrations\Dialpad\Tools;

/**
 * Token -- Authorize.
 *
 * Executes the official Dialpad API operation oauth2.authorize.get.
 */
class DialpadOauth2AuthorizeGet extends AbstractDialpadOperationTool
{
    protected const OPERATION = 'dialpad_oauth2_authorize_get';
}
