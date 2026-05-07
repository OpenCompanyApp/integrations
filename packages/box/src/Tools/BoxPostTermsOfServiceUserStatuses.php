<?php

namespace OpenCompany\Integrations\Box\Tools;

/**
 * Create terms of service status for new user.
 *
 * Executes the official Box API operation post_terms_of_service_user_statuses.
 */
class BoxPostTermsOfServiceUserStatuses extends AbstractBoxOperationTool
{
    protected const OPERATION = 'box_post_terms_of_service_user_statuses';
}
