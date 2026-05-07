<?php

namespace OpenCompany\Integrations\Box\Tools;

/**
 * Update terms of service.
 *
 * Executes the official Box API operation put_terms_of_services_id.
 */
class BoxPutTermsOfServicesId extends AbstractBoxOperationTool
{
    protected const OPERATION = 'box_put_terms_of_services_id';
}
