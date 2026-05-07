<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Retrieve the list of questions that are required for a tax location.
 *
 * Executes the official Avalara AvaTax REST API operation ListLocationQuestionsByAddress.
 */
class AvalaraListLocationQuestionsByAddress extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_list_location_questions_by_address';
}