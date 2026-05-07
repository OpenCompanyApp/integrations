<?php

namespace OpenCompany\Integrations\Airtop\Tools;

/**
 * Fill a form synchronously using a form-filler automation.
 *
 * Executes the official Airtop API operation fill-form.
 */
class AirtopSessionsWindowsFillForm extends AbstractAirtopOperationTool
{
    protected const OPERATION = 'airtop_sessions_windows_fill_form';
}
