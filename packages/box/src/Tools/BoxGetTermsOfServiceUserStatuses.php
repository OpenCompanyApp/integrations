<?php

namespace OpenCompany\Integrations\Box\Tools;

/**
 * List terms of service user statuses.
 *
 * Executes the official Box API operation get_terms_of_service_user_statuses.
 */
class BoxGetTermsOfServiceUserStatuses extends AbstractBoxOperationTool
{
    protected const OPERATION = 'box_get_terms_of_service_user_statuses';
}
