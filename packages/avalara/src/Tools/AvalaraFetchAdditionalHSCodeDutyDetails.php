<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Fetch Additional HS Duty Details for items.
 *
 * Executes the official Avalara AvaTax REST API operation FetchAdditionalHSCodeDutyDetails.
 */
class AvalaraFetchAdditionalHSCodeDutyDetails extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_fetch_additional_hs_code_duty_details';
}