<?php

namespace OpenCompany\Integrations\Dialpad\Tools;

/**
 * Token -- Deauthorize.
 *
 * Executes the official Dialpad API operation oauth2.deauthorize.post.
 */
class DialpadOauth2DeauthorizePost extends AbstractDialpadOperationTool
{
    protected const OPERATION = 'dialpad_oauth2_deauthorize_post';
}
