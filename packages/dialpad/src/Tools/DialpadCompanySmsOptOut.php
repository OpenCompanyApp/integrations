<?php

namespace OpenCompany\Integrations\Dialpad\Tools;

/**
 * Company -- Get SMS Opt-out List.
 *
 * Executes the official Dialpad API operation company.sms_opt_out.
 */
class DialpadCompanySmsOptOut extends AbstractDialpadOperationTool
{
    protected const OPERATION = 'dialpad_company_sms_opt_out';
}
