<?php

namespace OpenCompany\Integrations\CompaniesHouse\Tools;

/**
 * Retrieve a single officer appointment on a company.
 */
class CompaniesHouseOfficerAppointment extends AbstractCompaniesHouseTool
{
    protected const NAME = 'companies_house_officer_appointment';
    protected const DESCRIPTION = 'Retrieve one officer appointment for a company.';
    protected const METHOD = 'officerAppointment';
    protected const REQUIRED = ['company_number', 'appointment_id'];
    protected const PARAMETERS = [
        'company_number' => ['type' => 'string', 'required' => true, 'description' => 'Companies House company number.'],
        'appointment_id' => ['type' => 'string', 'required' => true, 'description' => 'Appointment identifier from the officers list.'],
    ];
}
