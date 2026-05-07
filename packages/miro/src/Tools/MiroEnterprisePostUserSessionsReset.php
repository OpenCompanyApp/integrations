<?php

namespace OpenCompany\Integrations\Miro\Tools;

/**
 * Reset all sessions of a user. Admins can now take immediate action to restrict user access to company data in case of security concerns. Calling this API ends all active Miro sessions across devices for a particular user, requiring the user to sign in again. This is useful in situations where a user leaves the company, their credentials are compromised, or there's suspicious activity on their account. Required scope sessions:delete Rate limiting Level 3 Enterprise only This API is available only for Enterprise plan users. You can only use this endpoint if you have the role of a Company Admin. You can request temporary access to Enterprise APIs using this form..
 *
 * Maps to the official Miro endpoint POST /v2/sessions/reset_all.
 */
class MiroEnterprisePostUserSessionsReset extends AbstractMiroTool
{
    protected const NAME = 'miro_enterprise_post_user_sessions_reset';
    protected const DESCRIPTION = 'Reset all sessions of a user. Admins can now take immediate action to restrict user access to company data in case of security concerns. Calling this API ends all active Miro sessions across devices for a particular user, requiring the user to sign in again. This is useful in situations where a user leaves the company, their credentials are compromised, or there\'s suspicious activity on their account. Required scope sessions:delete Rate limiting Level 3 Enterprise only This API is available only for Enterprise plan users. You can only use this endpoint if you have the role of a Company Admin. You can request temporary access to Enterprise APIs using this form.

Official Miro endpoint: POST /v2/sessions/reset_all.';
    protected const PARAMETERS = array (
      'email' => array (
        'type' => 'string',
        'description' => 'Email ID of the user whose sessions you want to reset. Note that this user will be signed out from all devices.',
        'required' => true,
      ),
    );
    protected const METHOD = 'POST';
    protected const PATH = '/v2/sessions/reset_all';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
      'email' => 'email',
    );
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
}
